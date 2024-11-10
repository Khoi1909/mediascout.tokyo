<?php
class database{
    public $con;
    public $host = "localhost";
    public $username = "root";
    public $password= "";
    public $database= "db";
    public function __construct(){
        $this -> con = mysqli_connect($this->host, $this->username, $this->password);
        mysqli_select_db($this -> con, $this->database);
        mysqli_query($this -> con, "SET NAMES utf8");
    }
}