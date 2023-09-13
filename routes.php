<?php 

require_once 'path-loader.php';

Router::get('/', 'views/home.php');
Router::get('/about', 'views/about.php');
Router::get('/contact', 'views/contact.php');