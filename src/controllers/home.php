<?php
class Home extends controller{
    function Index(){
        #$indexpage= $this->model("homepage"."models");
        $this->view("mainlayout", [
            "Page"=>"homepage"
        ]);
    }
    function login(){
        $this->view("loginlayout", [
            "Page"=>"login"
        ]);
    }
    function register(){
        $this->view("loginlayout", [
            "Page"=>"register"
        ]);
    }
}
