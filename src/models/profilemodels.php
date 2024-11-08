<?php
class profilemodels extends databaseconnect{
    public function getuserprofile(){
        return "User profile here";
    }
    public function getuserinfo(){
        $qr = "SELECT * FROM users";
        return mysqli_query($this->conn,$qr);
    }
}