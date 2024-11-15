<?php
class database{
    public $con;
    public $host = "db.mediascout.tokyo";
    public $username = "mediascout";
    public $password= "media123scout";
    public $database= "mediascout";
    public function __construct(){
        $this -> con = mysqli_connect($this->host, $this->username, $this->password);
        mysqli_select_db($this -> con, $this->database);
        mysqli_query($this -> con, "SET NAMES utf8");
    }
}