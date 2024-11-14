<?php
class Register extends Controller{
    function index(){
        $this->view("loginlayout", [
            "Page"=>"register"
        ]);
    }
}