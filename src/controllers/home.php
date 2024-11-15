<?php
class Home extends controller
{
    function Index()
    {
        #$indexpage= $this->model("homepage"."models");
        $this->view("mainlayout", [
            "Page" => "home"
        ]);
    }
}