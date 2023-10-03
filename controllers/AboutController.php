<?php 

require_once './core/titan.php';
require_once './core/view-loader.php';

class About {

    static function index() {
        view("About/about.php");
    }
    
}