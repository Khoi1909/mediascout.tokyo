<?php
class Register extends Controller{
    function index(){
        $this->model("register"); 
        $this->view("loginlayout", [
            "Page"=>"register"
        ]);
    }
}