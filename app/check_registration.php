<?php
    require_once("../vendor/autoload.php");
    session_start();

    $logister = [
        "name" => htmlspecialchars(trim($_POST["name"])),
        "email" => htmlspecialchars(trim($_POST["email"])),
        "pass" => htmlspecialchars(trim($_POST["pass"]))
    ];

    foreach($_POST as $value) {
        if(empty($value)) {
            echo "У вас пусте поле {$value}. Заповніть його";
            exit;
        }
    }

    $user = new App\User();
    $results = $user->createUser($logister["name"], $logister["email"], $logister["pass"]);
    if ($results > 1) {
        echo "Такий Аккаунт вже існує";
        exit;
    } else {
        header("Location:/public/index.php");
    }
?>