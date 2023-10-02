<?php 

require_once 'path-loader.php';
require_once './controllers/HomeController.php';
require_once './controllers/AboutController.php';
require_once './controllers/ContactController.php';

Route::get("/", function() {
    Home::index();
});

Route::post("/upload", function() {
    Home::upload();
});

Route::get("/about", function() {
    About::index();
});

Route::get("/contact", function() {
    Contact::index();
});
