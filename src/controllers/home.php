<?php
class Home extends controller{
    function Index(){
        #$indexpage= $this->model("homepage"."models");
        $this->view("mainlayout", [
            "Page"=>"home"
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
//    function profile(){
//        $user = $this->model("usermodel");
//        #echo $this->model("usermodel");
//        $this->view("mainlayout", [
//            "User"=>$user->getuserinfo(),
//            "Page"=>"userpage"
//        ]);
//    }
}
