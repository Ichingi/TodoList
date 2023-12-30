<?php require_once("../vendor/autoload.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mate | Registration</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="container registration">
        <div class="form-content">
            <h1>Реєстрація</h1>
            <form class="registration__form" action="/app/check_registration.php" method="post">
                <input type="text" name="name" placeholder="Ім'я">
                <input type="email" name="email" placeholder="Пошта">
                <input type="password" name="pass" placeholder="Пароль">
                <input type="submit" value="Зареєструватись">
            </form>
            <a class="form__sublink" href="/app/login.php">Є Аккаунт? Авторизуватись</a>
        </div>
    </div>
    <footer>
        <h3>Copyright © Tima.com</h3>
    </footer>
</body>

</html>