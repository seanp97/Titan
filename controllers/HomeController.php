<?php 
require_once './titan.php';
require_once './view-loader.php';

class Home {
    static function index() {
        view("home.php");
    }
}