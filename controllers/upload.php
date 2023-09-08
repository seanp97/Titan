<?php 
require "../titan.php";

if(Titan::IsSubmit()) {
    $uploadStatus = Titan::FileUpload("fileToUpload", array("jpg", "jpeg"), 100);

    if($uploadStatus == "Success") {
        Titan::Redirect("https://www.youtube.com");
    }
}