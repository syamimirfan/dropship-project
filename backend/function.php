<?php 
   
   session_start();
  
   define('SITEURL','http://localhost/dropship-project/');
   
   class Connection {
      public $host = "localhost";
      public $user = "root";
      public $password = "";
      public $db_name = "dropship-project";
      public $conn;

      //get the connection 
      public function __construct() {
          $this->conn = mysqli_connect($this->host,$this->user,$this->password,$this->db_name);
      }
   }
    
?>