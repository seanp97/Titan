<?php 
require_once './core/auto-loader.php';

class About {

    static function index() {
        // Load index.php file in views/About folder
        view("About/index");
    }

}