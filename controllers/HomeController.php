<?php 

require_once './core/titan.php';
require_once './core/view-loader.php';

class Home {

    static function index() {
        view("Home/home.php");
    }
    
}