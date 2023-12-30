<?php
    require_once("../vendor/autoload.php");
    $data = [
      "title" => htmlspecialchars(trim($_POST["title"])),
      "description" => htmlspecialchars(trim($_POST["descriptionn"]))
    ]; 

    if(empty($data['title'])) {
        echo "Вы не ввели назву завдання";
        exit;
    } 
    else if(empty($data['description'])) {
        echo "Ви не ввели опис завдання";
        exit;
    }
    else {
        $todo = new App\Todo();
        $todo->createTodo($data['title'], $data['description']);
        header("Location: /public/index.php");
    }
?>