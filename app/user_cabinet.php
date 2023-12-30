<?php
    require_once("../vendor/autoload.php");
    session_start();
    use App\DateBase;

    App\User::isLogin($_SESSION["login"], "/app/registration.php");

    $db = new DateBase();
    $stmt = $db->conn->prepare("SELECT * FROM `reg_log` WHERE `name` = ? OR `email` = ?");
    $stmt->execute([$_SESSION['login'], $_SESSION['login']]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mate | User cabinet</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <header class="header">
        <a href="../public/index.php" class="back-page">
            <svg width="30" height="23">
                <use xlink:href="../public/assets/images/icons.svg#leave-btn"></use>
            </svg>
        </a>
    </header>
    <main class="main-info">
        <div class="container">
            <div class="content">
                <div class="main-info__content">
                    <input type="file" name="file" id="avatar">
                    <label for="avatar">
                        <img class="avatar" src="<?= $results['avatar'] ?>" alt="Avatar">
                    </label>
                    <form class="main-info__person-info" action="checked/edit_profile.php?id=<?= $results['id'] ?>" method="post" enctype="multipart/form-data">
                        <input class="main-info__item" type="text" value="<?= $results['name'] ?>" name="name" placeholder="Введіть свій нікнейм">
                        <input class="main-info__item" type="email" value="<?= $results['email'] ?>" name="email" placeholder="Введіть свою пошту">
                        <input class="main-info__item" type="text" value="<?= $results['pass'] ?>" name="password" placeholder="Введіть свій пароль">
                        <input class="main-info__item" type="text" value="<?= $results['avatar'] ?>" name="avatar" placeholder="Введіть посилання на аватарку">
                        <input class="button" type="submit" value="Зберегти">
                    </form>
                </div>
                <div class="buttons">
                    <a class="button btn-red" href="checked/exit_account.php">Вийти</a>
                    <a class="button btn-red">Видалити</a>
                </div>
            </div>
        </div>
        <footer>
            <h3>Copyright © Tima.com</h3>
        </footer>
    </body>
</html>
