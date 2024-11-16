<?php
    class Profile extends Controller
    {
        public function index(){
            $this->view('mainlayout',[
                "Page" => "userprofile"
            ]);
        }
        public function edit()
        {
            $this->view('mainlayout',[
                "Page" => "profile-edit"
            ]);
        }
        public function update() {
            $this->model("save-profile");
        }
    }