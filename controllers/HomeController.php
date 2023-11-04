<?php 
require_once './core/auto-loader.php';

class Home {

    static function index() {
        // Load index.php file in views/Home folder
        view("Home/index");
    }

}