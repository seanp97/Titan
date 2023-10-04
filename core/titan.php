<?php 

class Titan {

    public $mysqli;
    public $queryBuilder;

    function __construct() {
        $this->Connect();
    }

    function Connect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'db';

        $this->mysqli = new mysqli($host, $user, $pass, $db);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }

        return $this->mysqli;
    }

    function select($values = '') {
        if(!empty($values)) {
            $this->queryBuilder .= "SELECT $values";
        }
        else {
            $this->queryBuilder .= "SELECT";
        }
        
        return $this;
    }

    function all() {
        $this->queryBuilder .= " *";
        return $this;
    }

    function from($table) {
        $this->queryBuilder .= " FROM $table";
        return $this;
    }

    function where($q) {
        $this->queryBuilder .= " WHERE $q";
        return $this;
    }

    function and($q) {
        $this->queryBuilder .= " AND $q";
        return $this;
    }

    function or($q) {
        $this->queryBuilder .= " OR $q";
        return $this;
    }

    function equals($e) {
        $this->queryBuilder .= " = '$e'";
        return $this;
    }

    function get() {
        try {
            $result = mysqli_query($this->Connect(), $this->queryBuilder);

            if (!$result) {
                die(mysqli_error($this->Connect()));
            }
    
            if (mysqli_num_rows($result) > 0) {
    
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }

                echo $this->queryBuilder;
                return $data;
            } 
        }

        catch(Exception $e) {
            throw new Exception("Error querying database. " . $e);
        }
    }

}