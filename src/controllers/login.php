<?php
class login extends Controller{
    function index(){
        $this->model("login");
        $this->view("loginlayout", [
            "Page"=>"login"
        ]);
    }
    
    function forgot_password() {
        //$this->model("forgot_password");
        require_once "src/models/forgot_password.php";
                
        $this->view("loginlayout", [
            "Page"=>"forgot_password"
        ]);
    } 
}
?>