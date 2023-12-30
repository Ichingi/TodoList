<?php
namespace App;

use PDO;

class User
{
  private string $name;
  private string $email;
  private string $pass;
  private DateBase $db;

  public function __construct()
  {
    $this->db = new DateBase();
  }

  public function createUser($name, $email, $pass)
  {
    $stmt = $this->db->conn->prepare("SELECT * FROM `reg_log` WHERE `name`= ? OR `email`=?");
    $stmt->execute([$name, $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result > 1) {
      return 0;
    } else {
      $stmt = $this->db->conn->prepare("INSERT INTO `reg_log`( `name`, `email`, `pass`) VALUES (?,?,?)");
      $stmt->execute([$name, $email, $pass]);
      $_SESSION["login"] = $name;
      return $stmt->rowCount() > 0;
    }
  }
  public function loginUser($login, $pass)
  {
    $stmt = $this->db->conn->prepare("SELECT * FROM `reg_log` WHERE `name`= ? OR `email` = ? AND `pass` = ?");
    $stmt->execute([$login, $login, $pass]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result > 1) {
      $_SESSION["login"] = $result["name"];
      return 1;
    } else {
      return 0;
    }
  }
  static function logoutUser($name){
    if(isset($_SESSION['login'])){
      unset($_SESSION['login']);
      return 1;
    } else {
      return 0;
    }
  } 
  static function isLogin($name, $url){
    if(isset($_SESSION['login'])){
      return 1;
    } else {
      header("Location: $url");
    }
  }
}
