<?php 
require_once './titan.php';
require_once './view-loader.php';

class Contact {
    static function index() {
        view("contact.php");
    }
}