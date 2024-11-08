<?php
class Anime extends Controller{
    function index()
    {
        $this->view("animepage");
    }
    function search($i) {
        $anisearch = $this ->model("anime"."models");
        $animeID = $anisearch -> animesearching($i);
        $this->view("resultpage", ["ID"=>$animeID]);
    }
}