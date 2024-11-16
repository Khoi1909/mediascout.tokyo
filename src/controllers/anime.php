<?php
class Anime extends Controller{
    function index()
    {
        $this->view("mainlayout", [
            "Page" => "home", ]);
    }
    function info($id) {
        $this->view("mainlayout", [
            "Page"=>"anime-details",
            "animeid"=> $id,
        ]);
    }
    function search()
    {
        $this->view("mainlayout", [
            "Page"=>"search",
        ]);
    }
    function result($query)
    {
        $this->view("mainlayout", [
            "Page"=>"search-result",
            "animeName"=> $query,
        ]);
    }
    function TopRated()
    {
        $this->view("mainlayout", [
            "Page" => "view-top-rated",
        ]);
    }
    function Upcoming(){
        $this->view ("mainlayout", [
            "Page" => "view-upcoming",
        ]);
    }

    function Seasonal()
    {
        $this->view ("mainlayout", [
            "Page" => "view-seasonal",
        ]);
    }
}