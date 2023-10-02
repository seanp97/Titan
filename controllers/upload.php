<?php 
require "../titan.php";

$uploadStatus = Titan::FileUpload("fileToUpload", array("jpg", "jpeg"), 100);
if($uploadStatus != "Unsuccessful") {
    Titan::Redirect("http://localhost/Titan");
}