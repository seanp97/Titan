<?php 
require "../titan.php";

$uploadStatus = Titan::FileUpload("fileToUpload", array("jpg", "jpeg"), 100);
if($uploadStatus != "Unsuccessful") {
    Titan::InsertInto("Images", "ImageFileName, ImageText", "'$uploadStatus', 'Hello World'");
    Titan::Redirect("http://localhost/Titan");
}