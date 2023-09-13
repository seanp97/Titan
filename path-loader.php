<?php 

class Router {

    static function get($path, $file) {
        try {
            $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
            $uri = Explode('/', $uri);
            $uri = $uri[count($uri) - 1];
            $uri = '/' . $uri;

            if(str_contains($file, 'views')) {
                if($uri == $path) {
                    require $file;
                }
            }
            else {
                if($uri == $path) {
                    require 'views/' . $file;
                }
            }
            
        }
        catch(Exception $e) {
            echo $e;
        }

    }
}