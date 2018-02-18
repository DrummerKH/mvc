<?php

namespace App\Controllers;


use App\Exceptions\UserException;
use App\Factories\PaymentsFactory;
use App\Traits\Auth;
use Core\Contracts\AbstractController;

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
        if ($this->authAuthorized()) {
            $this->response->redirect('/user/withdraw', 302);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $params = [];

        if ($this->request->isPost()) {

            $error = '';

            try {

                if (!$username) {
                    throw new UserException('Username not specified');
                }

                if (!$password) {
                    throw new UserException('Password not specified');
                }

                if (!$this->authAuthorize($username, $password)) {
                    throw new UserException('Incorrect login data');
                }

                $this->response->redirect('/user/withdraw', 302);

            } catch (UserException $e) {
                $error = $e->getMessage();
            }

            $params = [
                'error' => $error
            ];
        }

        $this->response->render('login', $params);
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
     * @throws \Exception
     */
    public function withdraw(): void
    {
        if (!$this->authAuthorized()) {
            $this->response->redirect('/user/login', 302);
        }

        if (!$user = $this->authGetUser()) {
            throw new UserException('User not found');
        }

        $amount = floatval($this->request->getPost('amount', 0));

        $params = [];

        $balance = $user->getBalance();

        if ($this->request->isPost()) {

            $error = '';

            try {

                if ($amount <= 0) {
                    throw new UserException('Amount must be greater than 0');
                }

                PaymentsFactory::create()->withdraw($user, $amount);
                $balance = \bcsub($balance, $amount, 2);

            } catch (UserException $e) {
                $error = $e->getMessage();
            }

            $params = [
                'error' => $error
            ];
        }

        $params['balance'] = $balance;
        $params['username'] = $user->getName();

        $this->response->render('withdraw', $params);
    }
}