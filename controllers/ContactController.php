<?php 
require_once './core/auto-loader.php';

class Contact {

    static function index() {
        // Load index.php file in views/Contact folder
        view("Contact/index");
    }

}