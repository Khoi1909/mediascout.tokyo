<?php
class Anime extends Controller{
    function index()
    {
        $this->view("mainlayout", [
            "Page" => "animes", ]);
    }
    function Popular()
    {
        $this->view("mainlayout", [
            "Page" => "view-popular",
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
//    function search($i) {
//        $anisearch = $this ->model("anime"."models");
//        $animeID = $anisearch -> animesearching($i);
//        $this->view("result", ["ID"=>$animeID]);
//    }
}