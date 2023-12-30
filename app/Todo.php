<?php
    namespace App;

    class Todo{
        private string $title;
        private DateBase $db;

        public function __construct() {
            $this->db = new  DateBase;
        }
        public function createTodo($title, $desctiption) {

            $stmt = $this->db->conn->prepare("INSERT INTO `todo_List`(`title`, `description`) VALUES (?, ?)");
            $stmt->execute([$title, $desctiption]);
        }

    }
?>