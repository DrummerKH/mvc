<h1>Withdrawal</h1>

Logged User: <?= $username?>: Balance <?= $balance?>

<form action="/user/withdraw" method="post">
    <label for="amount" >
        Amount
        <input type="text" name="amount">
    </label>

    <button type="submit">Withdraw</button>
</form>

<form action="/user/logout" method="post">
    <button>Logout</button>
</form>