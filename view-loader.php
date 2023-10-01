<?php 

function view($file) {
    if(str_contains($file, 'views')) {
        require $file;
    }
    else {
        require 'views/' . $file;
    }
}