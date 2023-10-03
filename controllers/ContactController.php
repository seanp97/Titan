<?php 

require_once './core/titan.php';
require_once './core/view-loader.php';

class Contact {

    static function index() {
        view("Contact/contact.php");
    }
    
}