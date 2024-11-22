<?php
class login extends Controller{
    function index(){
        $this->model("login");
        $this->view("loginlayout", [
            "Page"=>"login"
        ]);
    }
    
    function forgot_password() {
        $this->model("forgot_password");
        $this->view("loginlayout", [
            "Page"=>"forgot_password"
        ]);
    } 
}
?>