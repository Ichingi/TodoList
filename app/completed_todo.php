<?php
    require_once("../vendor/autoload.php");
    use App\DateBase;

    $id = htmlspecialchars(trim($_GET['id']));
    $db = new DateBase();

    $stmt = $db->conn->prepare('SELECT * FROM `todo_List` WHERE `id` = ?');
    $stmt->execute([$id]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($results['id'] > 0) {
        echo'Такого завдання не існує';
        exit;
    } else{
        $stmt = $db->conn->prepare('UPDATE `todo_List` SET `completed` = 1 WHERE `id` = ?');
        $stmt->execute([$id]);
        header("Location: /public/index.php");
    }
?>