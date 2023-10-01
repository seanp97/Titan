<?php 

require_once 'path-loader.php';

Router::path('/', 'home.php');
Router::path('/about', 'about.php');
Router::path('/contact', 'contact.php');