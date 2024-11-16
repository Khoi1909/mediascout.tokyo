<?php
class Home extends controller
{
    function Index()
    {
        $this->view("mainlayout", [
            "Page" => "home"
        ]);
    }

    function Profile(){
        $this->view("mainlayout", [
            "Page" => "userprofile"
        ]);
    }
}