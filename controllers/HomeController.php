<?php 
require_once './titan.php';
require_once './view-loader.php';

class Home {
    static function index() {
        view("Home/home.php");
    }

    static function upload() {
        $uploadStatus = Titan::FileUpload("fileToUpload", array("jpg", "jpeg"), 100);
        if($uploadStatus != "Unsuccessful") {
            Titan::Redirect("http://localhost/Titan");
        }
    }
}