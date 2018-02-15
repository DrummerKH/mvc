<?php

namespace App\Controllers;

use App\Contracts\AbstractPayments;
use App\Exceptions\UserException;
use App\Repositories\UsersRepository;
use App\Traits\Auth;
use Core\Contracts\AbstractController;
use Core\MysqlStorage;
use App\Services\Payments;

/**
 * Created by PhpStorm.
 * User: Drummer1
 * Date: 14.02.18
 * Time: 12:04
 */

class UserController extends AbstractController
{
    use Auth;

    /**
     * Service instance
     * @var Payments
     */
    public $payments;

    /**
     * Default method
     */
    public function index(): void
    {
        $this->response->redirect('/user/login', 302);
    }

    /**
     * Login user
     */
    public function login(): void
    {
        if($this->authAuthorized())
            $this->response->redirect('/user/withdraw', 302);

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $params = [];
        $view = 'login';

        if($this->request->isPost()) {

            $error = '';

            try {

                if(!$username)
                    throw new UserException('Username not specified');

                if(!$password)
                    throw new UserException('Password not specified');

                if(!$this->authAuthorize($username, $password))
                    throw new UserException('Incorrect login data');

                $view = 'withdraw';

            } catch (UserException $e) {
                $error = $e->getMessage();
            }

            $params = [
                'error' => $error
            ];
        }

        $this->authCloseSession();

        $this->response->render($view, $params);
    }

    /**
     * Logout user
     */
    public function logout(): void
    {
        $this->authLogout();
        $this->response->redirect('/user/login', 302);
    }

    /**
     * Withdraw money
     */
    public function withdraw(): void
    {
        if(!$this->authAuthorized())
            $this->response->redirect('/user/login', 302);

        $user = $this->authGetUser();
        $this->authCloseSession();

        $user_id = $user->getId();
        $amount = floatval($this->request->getPost('amount'));

        $params = [];

        if($this->request->isPost()) {

            $error = '';

            try {

                if($amount <= 0)
                    throw new UserException('Amount must be greater than 0');

                if(!$user_id)
                    throw new UserException('Specified incorrect user');

                $this->setPaymentsService(new Payments(new MysqlStorage));
                $this->payments->transaction($user_id, -$amount);
                $user = (new UsersRepository(new MysqlStorage()))->findById($user_id);

            } catch (UserException $e) {
                $error = $e->getMessage();
            }

            $params = [
                'error' => $error
            ];
        }

        $params['balance'] = $user->getBalance();
        $params['username'] = $user->getName();

        $this->response->render('withdraw', $params);
    }

    /**
     * Set payments service
     * @param AbstractPayments $payments
     */
    protected function setPaymentsService(AbstractPayments $payments): void
    {
        $this->payments = $payments;
    }
}