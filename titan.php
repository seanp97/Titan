<?php

class Titan {

    private static $host;
    private static $user;
    private static $pass;
    private static $db;
    public static $mysqli;

    function __construct() {
        Titan::Connect();
        header('Access-Control-Allow-Origin: *');
    }

    static function Connect() {
        Titan::$host = 'localhost';
        Titan::$user = 'root';
        Titan::$pass = '';
        Titan::$db = '';

        Titan::$mysqli = new mysqli(Titan::$host, Titan::$user, Titan::$pass, Titan::$db);

        if (Titan::$mysqli->connect_error) {
            die("Connection failed: " . Titan::$mysqli->connect_error);
        }

        return Titan::$mysqli;
    }

    static function Select($sql) {

        try {
            $result = mysqli_query(Titan::Connect(), $sql);

            if (!$result) {
                die(mysqli_error(Titan::$mysqli));
            }
    
            if (mysqli_num_rows($result) > 0) {
    
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
    
                return $data;
            } 
        }

        catch(Exception $e) {
            throw new Exception("Error querying database. " . $e);
        }

    }

    static function GetSession($variable) {
        return $_SESSION[$variable];
    }

    static function SetSession($variable) {
        $_SESSION[$variable];
    }

    static function GetAll($table) {
        try {
            $result = mysqli_query(Titan::Connect(), "SELECT * FROM " . $table);

            if (!$result) {
                die(mysqli_error(Titan::$mysqli));
            }
    
            if (mysqli_num_rows($result) > 0) {
    
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
    
                return $data;
            } 
        }

        catch(Exception $e) {
            throw new Exception("Error querying database. " . $e);
        }
    }

    static function SQL($sql) {
        if (!mysqli_query(Titan::Connect(), $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error(Titan::$mysqli);
        } 
    }

    static function CallStoredProcedure($ProcName) {

        try {
            mysqli_query(Titan::Connect(), "CALL $ProcName");
        }
        catch(Exception $e) {
            echo $e;
        }
        
    }

    static function JSONShow($query) {

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

    static function InsertInto($table, $tableFields, $values) {

        try {
            $insertSQL = "INSERT INTO $table ($tableFields)
            VALUES ($values)";
    
            if (!Titan::Connect()->query($insertSQL) === TRUE) {
                echo "Error: " . $insertSQL . "<br>" . Titan::$mysqli->error;
            }
        }
        catch(Exception $e) {
            throw new Exception($e);
        }

    }

    static function PostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    static function GetRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    static function PutRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'PUT';
    }

    static function PatchRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'PATCH';
    }

    static function DeleteRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'DELETE';
    }

    static function GetCookie($cookie) {

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

    static function QueryString($param) {

        try {
            if(isset($_GET[$param])) {
                return $_GET[$param];
            }
        }
        catch(Exception $e) {
            throw new Exception("No parameters set. " . $e);
        }
    }

    static function Title($title) {
        echo "<script type='text/javascript'>document.title = '{$title}'</script>";
    }

    static function GetJSON($url) {
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

    static function FileUpload($name, $allowedFileTypes, $fileSize) {
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

    static function IsSubmit() {
        if(isset($_POST['submit'])) return true;
        return false;
    }

    static function ValidEmail($email) {
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

    static function Redirect($url) {
        try {
            header("Location: " . $url);
            die();
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    static function GetPostValue($val) {
        try {
            return $_POST[$val];
        }
        catch(Exception $e) {
            echo $e;
        }
    }

}
