<?php

function JSONShow($query) {

    try {
        header('Content-Type: application/json');

        $arr = array();

        if($query) {
            foreach ($query as $a) {
                array_push($arr, $a);
            } 

            echo json_encode($arr, JSON_PRETTY_PRINT);
        }
    }

    catch(Exception $e) {
        throw new Exception($e);
    }

}

function Status200() {
    header("HTTP/1.0 200 OK");
}

function Status301() {
    header("HTTP/1.0 301 Permanent Redirect");
}

function Status302() {
    header("HTTP/1.0 302 Temporary Redirect");
}

function Status400() {
    header("HTTP/1.0 400 Bad Request");
}

function Status401() {
    header("HTTP/1.0 401 Unauthorized Error");
}

function Status403() {
    header("HTTP/1.0 403 Forbidden");
}

function Status404() {
    header("HTTP/1.0 404 Not Found");
}

function Status500() {
    header("HTTP/1.0 500 Internal Server Error");
}

function GetSession($variable) {
    return $_SESSION[$variable];
}

function SetSession($variable, $value) {
    $_SESSION[$variable] = $value;
}

function FileUpload($name, $allowedFileTypes, $fileSize) {
    $file = $_FILES[$name];

    if($file["error"] === 0) {
        $fileName = $file["name"];
        $fileType = explode(".", $fileName);
        $fileTypeExt = end($fileType);

        if(in_array($fileTypeExt, $allowedFileTypes)) {
            if($file["size"] < $fileSize * 10000) {
                $newFile = uniqid("", true) . time() . "." . $fileTypeExt;
                $targetDir = dirname(__FILE__) . "/uploads/" . $newFile;
                $uploadSucess = move_uploaded_file($file["tmp_name"], $targetDir);
                if($uploadSucess) {
                    return $newFile;
                }
                else {
                    return "Unsuccessful";
                }
            }
            else {
                return "File size too big";
            }
        }
        else {
            return "Not allowed file type";
        }
    } 
    else {
        return "Error uploading file";
    }

}

function PostRequest() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function GetRequest() {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function PutRequest() {
    return $_SERVER['REQUEST_METHOD'] === 'PUT';
}

function PatchRequest() {
    return $_SERVER['REQUEST_METHOD'] === 'PATCH';
}

function DeleteRequest() {
    return $_SERVER['REQUEST_METHOD'] === 'DELETE';
}

function GetCookie($cookie) {

    try {
        if(isset($_COOKIE[$cookie])) {
            return $_COOKIE[$cookie];
        } 
        else {
            return "No Cookie set.";
        }
    }
    catch(Exception $e) {
        throw new Exception($e); 
    }

} 

function QueryString($param) {

    try {
        if(isset($_GET[$param])) {
            return $_GET[$param];
        }
    }
    catch(Exception $e) {
        throw new Exception("No parameters set. " . $e);
    }
}

function Title($title) {
    echo "<script type='text/javascript'>document.title = '{$title}'</script>";
}

function GetJSON($url) {
    try {
        $jsonUrl = $url;
        $json = file_get_contents($jsonUrl);
        $data = json_decode($json, TRUE);
        return $data;
    }
    catch(Exception $e) {
        throw new Exception($e);
    }
}

function ValidEmail($email) {
    try {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
    catch(Exception $e) {
        echo $e;
    }
}

function Redirect($url) {
    try {
        header("Location: " . $url);
        die();
    }
    catch(Exception $e) {
        echo $e;
    }
}

function PostValue($val) {
    try {
        if(isset($_POST[$val])) {
            return $_POST[$val];
        }
        else {
            return "value not set";
        }
    }
    catch(Exception $e) {
        echo $e;
    }
}