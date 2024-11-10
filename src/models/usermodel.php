<?php
class usermodel extends database {
    public function getuserinfo(){
        $qr = "SELECT * FROM users";
        return mysqli_query($this->con,$qr);
    }
}