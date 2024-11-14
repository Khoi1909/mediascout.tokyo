<?php
class Home extends controller{
    function Index(){
        #$indexpage= $this->model("homepage"."models");
        $this->view("mainlayout", [
            "Page"=>"home"
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
