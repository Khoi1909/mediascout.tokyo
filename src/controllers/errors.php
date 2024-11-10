<?php
class errors extends Controller
{
    function Index()
    {
        $this->view("errorlayout",[
            "Page"=>"errorpage"
        ]);
    }
    function Error404()
    {

    }
}