<?php 

require_once 'path-loader.php';

Router::get('/', 'home.php');
Router::get('/about', 'about.php');
Router::get('/contact', 'contact.php');