<?php 
require_once './titan.php';
require_once './view-loader.php';

class About {
    static function index() {
        view("about.php");
    }
}