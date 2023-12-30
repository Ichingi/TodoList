<?php
    namespace App;
    use PDO;
    use PDOException;

    class DateBase{

        private string $host = 'localhost';
        private string $dbname = 'todo_list'; 
        private string $name = 'root'; 
        private string $pass = ''; 
        public PDO $conn;

            public function  __construct() {
            try {
                $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->name, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }
?>