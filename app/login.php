<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mate | Authorization</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="container authorization">
        <div class="form-content">
            <h1>Авторизація</h1>
            <form class="authorization__form" action="/app/check_login.php" method="post">
                <input type="text" name="loginnawn" placeholder="Логін">
                <input type="password" name="pass" placeholder="Пароль">
                <input type="submit" value="Авторизуватись">
            </form>
            <a class="form__sublink" href="/app/registration.php">Немає аккаунту? Зареєструйтесь</a>
        </div>
    </div>
    <footer>
        <h3>Copyright © Tima.com</h3>
    </footer>
</body>

</html>