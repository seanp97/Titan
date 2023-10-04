<?php 

require_once './core/titan.php';
require_once './core/view-loader.php';

class About {

    static function index() {
        // Load index.php file in views/About folder
        view("About/index");
    }

}