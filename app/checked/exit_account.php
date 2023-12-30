<?php
    require_once("../../vendor/autoload.php");
    session_start();

    if(!App\User::logoutUser($_SESSION['login'])) {
        echo "Помилка, повідомте <a href=\"https://t.me/murphez\">розробнику</a>";
        exit;
    } header("Location: /app/login.php");
?>