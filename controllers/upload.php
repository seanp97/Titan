<?php 
require "../titan.php";

if(Titan::IsSubmit()) {
    $uploadStatus = Titan::FileUpload("fileToUpload", array("jpg", "jpeg"), 100);
    echo $uploadStatus;
}