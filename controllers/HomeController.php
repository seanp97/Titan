<?php 

require_once './core/titan.php';
require_once './core/view-loader.php';

class Home {

    static function index() {
        // Load home.php file in views/Home folder
        view("Home/home");
    }

}