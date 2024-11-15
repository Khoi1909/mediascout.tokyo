<?php

class Error404 extends controller
{
    function index(){
        $this->view("errorlayout",[
            "Page"=>"errorpage"
        ]);
    }
}