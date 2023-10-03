<?php 
require_once './titan.php';
require_once './view-loader.php';

class Home {
    static function index() {
        view("Home/home.php");
    }

    static function UploadImage() {
        $uploadStatus = Titan::FileUpload("fileToUpload", array("jpg", "jpeg"), 100);
        if($uploadStatus != "Unsuccessful") {
            Titan::Redirect("http://localhost/Titan");
        }
    }
}