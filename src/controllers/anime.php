<?php
class Anime extends Controller{
    function index()
    {
        $this->view("mainlayout", [
            "Page" => "animes", ]);
    }
//    function search($i) {
//        $anisearch = $this ->model("anime"."models");
//        $animeID = $anisearch -> animesearching($i);
//        $this->view("result", ["ID"=>$animeID]);
//    }
}