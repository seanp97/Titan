<?php

require_once 'helper.php';

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
        Titan::$db = 'db';

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

}
