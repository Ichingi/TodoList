<?php
    require_once("../vendor/autoload.php");
    session_start();

    $data = [
        "login" => htmlspecialchars(trim($_POST["login"])),
        "pass" => htmlspecialchars(trim($_POST["pass"]))
    ];

    foreach($_POST as $value) {
        if(empty($value)) {
            echo "У вас пусте поле {$value}. Заповніть його";
            exit;
        }
    }

    $user = new App\User();
    if ($user->loginUser($data["login"], $data["pass"])) {
        $_SESSION[$data["login"]];
        header("Location:/public/index.php");
    } else {
        echo "неправильний логін або пароль";
        exit;
    }
?>