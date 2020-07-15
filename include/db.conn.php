<?php
class Database{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $mysqli;
  
    public function __construct() {
      $this->db_connect();
    }
  
    private function db_connect(){
      $this->host = DB_SERVER;
      $this->user = DB_USERNAME;
      $this->pass = DB_PASSWORD;
      $this->db = DB_NAME;
  
      $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
      return $this->mysqli;
    }
  
    
    public function db_prepare($sql){
      $result = $this->mysqli->prepare($sql);
      return $result;
    }

    public function db_query($sql){
      $result = $this->mysqli->query($sql);
      return $result;
    }

    public function db_num($sql){
          $result = $this->mysqli->query($sql);
          return $result->num_rows;
    }

    public function db_fetch_obj($sql){
      $result = $this->mysqli->query($sql);
      if ( $result->num_rows > 0 ){
        while($row = mysqli_fetch_object($result)){
          $data[] = $row;
        }
        return $data;
      }
    }

    public function db_fetch_row($sql){
      $result = $this->mysqli->query($sql);
      if ( $result->num_rows > 0 ){
        while($row = mysqli_fetch_row($result)){
          $data[] = $row;
        }
        return $data;
      }
    }

    public function db_fetch_arr($sql){
        $result = $this->mysqli->query($sql);
        return mysqli_fetch_array($result);
    }
}
  