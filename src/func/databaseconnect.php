<?php
class DatabaseConnect{
    public $conn;
    public $host = "localhost";
    public $username = "root";
    public $password= "";
    public $database= "db";
    public function __construct(){
        $this -> conn = mysqli_connect($this->host, $this->username, $this->password);
        mysqli_select_db($this -> conn, $this->database);
        mysqli_query($this -> conn, "SET NAMES utf8");
    }
}