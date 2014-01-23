<?php
  
class DB {
  private $db = Array(
    "name" => "c9",
    "host" => "127.5.29.1",
    "port" => 3306,
    "user" => "jeffrey",
    "pass" => "mypass"
  );
  private $mysqli;
  
  public function __construct() {
    $this->mysqli = new mysqli($this->db["host"], $this->db["user"], $this->db["pass"], $this->db["name"], $this->db["port"]);
    
    if ($this->mysqli->connect_error) {
      $error = 'Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error;
    }
  }
  
  public function query($str) {
    return $this->mysqli->query($str); 
  }

  public function connected() {
    return $this->mysqli->ping();
  }
  
  public function escape_string($str) {
    return $this->mysqli->escape_string($str);
  }
}
?>