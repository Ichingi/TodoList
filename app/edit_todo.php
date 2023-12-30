<?php
    require_once("../vendor/autoload.php");
    use App\DateBase;

    $data = [
        "id" => htmlspecialchars(trim($_GET["id"])),
        "title" => htmlspecialchars(trim($_POST["title"])),
        "description" => htmlspecialchars(trim($_POST["description"]))
    ];
    $db = new DateBase();

    if(empty($data['title'])) {
        echo "Вы не ввели назву завдання";
        exit;
    } 
    else if(empty($data['description'])) {
        echo "Ви не ввели опис завдання";
        exit;
    }
    else {
        $stmt = $db->conn->prepare('UPDATE `todo_List` SET `title` = ?, `description` = ? WHERE `id` = ?');
        $stmt->execute([$data['title'], $data['description'], $data['id']]);
        header("Location: /public/index.php");
    }
?>