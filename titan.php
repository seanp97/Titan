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
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = '';

        $mysqli = new mysqli($host, $user, $pass, $db);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }

    static function Select($sql) {

        try {
            $result = mysqli_query(Titan::$mysqli, $sql);

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

    static function GetAll($table) {
        try {
            $result = mysqli_query(Titan::$mysqli, "SELECT * FROM " . $table);

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
        if (!mysqli_query(Titan::$mysqli, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error(Titan::$mysqli);
        } 
    }

    static function CallStoredProcedure($ProcName) {

        try {
            mysqli_query(Titan::$mysqli, "CALL $ProcName");
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
    
            if (!Titan::$mysqli->query($insertSQL) === TRUE) {
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
