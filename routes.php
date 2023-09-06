<?php 

// Get URI

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$uri = Explode('/', $uri);
$uri = $uri[count($uri) - 1];
$uri = '/' . $uri;

// Set routes

try {
    $routes = [
        '/' => 'views/home.php',
        '/about' => 'views/about.php',
        '/contact' => 'views/contact.php'
    ];
    
    if(array_key_exists($uri, $routes)) {
        require $routes[$uri];
    }
}

catch(Exception $e) {
    echo $e;
}
