<?php 

require_once './core/titan.php';
require_once './core/view-loader.php';

class Contact {

    static function index() {
        // Load index.php file in views/Contact folder
        view("Contact/index");
    }

}