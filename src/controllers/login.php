<?php
class login extends Controller{
    function index(){
        $this->view("loginlayout", [
            "Page"=>"login"
        ]);
    }
}