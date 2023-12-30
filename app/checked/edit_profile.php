<?php
    require_once("../../vendor/autoload.php");
    session_start();
    use App\DateBase;

    $db = new DateBase();

    $data = [
        "id" => htmlspecialchars(trim($_GET["id"])),
        "name" => htmlspecialchars(trim($_POST["name"])),
        "email" => htmlspecialchars(trim($_POST["email"])),
        "password" => htmlspecialchars(trim($_POST["password"])),
        "avatar" => htmlspecialchars(trim($_POST["avatar"]))
    ];

    foreach ($_POST as $value) {
        if (empty($value)) {
            echo "У вас пусте поле {$value}. Заповніть його";
            exit;
        }
    }

    $stmt = $db->conn->prepare("SELECT * FROM `reg_log` WHERE `name` = ? OR `email` = ? ");
    $stmt->execute([$data["name"], $data["email"]]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($results > 1 && !$results['name'] == $_SESSION['login'] || !$results['email'] == $_SESSION['login']) {
        echo "Таке ім'я або пошта вже існує";
        exit;
    }

    $_SESSION['login'] = $data['name'];

    $stmt = $db->conn->prepare('UPDATE `reg_log` SET `name` = ?, `email` = ?, `pass` = ?, `avatar` = ? WHERE `id` = ?');
    $stmt->execute([$data['name'], $data['email'], $data['password'], $data['avatar'], $data['id']]);
    header("Location: /public/index.php");
?>
