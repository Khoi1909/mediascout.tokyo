<?php
class login extends Controller{
    function index(){
        $this->view("loginlayout", [
            "Page"=>"login"
        ]);
    }
    
    function forgot_password() {
        $this->view("loginlayout", [
            "Page"=>"forgot_password"
        ]);
    } 
}
?>