<?php 

require_once 'path-loader.php';
require_once './controllers/HomeController.php';
require_once './controllers/AboutController.php';
require_once './controllers/ContactController.php';

Router::get("/", function() {
    Home::index();
});

Router::get("/about", function() {
    About::index();
});

Router::get("/contact", function() {
    Contact::index();
});
