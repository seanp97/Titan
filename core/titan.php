<?php 
session_start();
require_once 'helper.php';

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
        $db = '';

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

    function all($table) {
        $this->queryBuilder .= "SELECT * FROM $table";
        return $this;
    }

    function select_query($query) {
        $this->queryBuilder .= "$query";
        return $this;
    }

    function sql_query($query) {
        $this->queryBuilder .= "$query";
        return $this;
    }

    function count($col) {
        $this->queryBuilder .= " COUNT($col)";
        return $this;
    }

    function from($table) {
        $this->queryBuilder .= " FROM $table";
        return $this;
    }

    function innerjoin($table) {
        $this->queryBuilder .= " INNER JOIN $table";
        return $this;
    }

    function on($q) {
        $this->queryBuilder .= " ON $q";
        return $this;
    }

    function delete() {
        $this->queryBuilder .= "DELETE";
        return $this;
    }

    function insertinto($table) {
        $this->queryBuilder .= "INSERT INTO $table";
        return $this;
    }

    function columns($columns) {
        $this->queryBuilder .= " ($columns)";
        return $this;
    }

    function values($values) {
        $this->queryBuilder .= " VALUES($values)";
        return $this;
    }

    function first() {
        $this->queryBuilder .= " LIMIT 1";
        return $this;
    }

    function like($q) {
        $this->queryBuilder .= " LIKE '%$q%'";
        return $this;
    }

    function update($table) {
        $this->queryBuilder .= "UPDATE $table";
        return $this;
    }

    function set($value) {
        $this->queryBuilder .= " SET $value";
        return $this;
    }

    function desc($q) {
        $this->queryBuilder .= " ORDER BY $q DESC";
        return $this;
    }

    function asc($q) {
        $this->queryBuilder .= " ORDER BY $q ASC";
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
        $this->queryBuilder .= " = $e";
        return $this;
    }

    function equals_str($e) {
        $this->queryBuilder .= " = '$e'";
        return $this;
    }

    function gt($q) {
        $this->queryBuilder .= " > $q";
        return $this;
    }

    function lt($q) {
        $this->queryBuilder .= " < $q";
        return $this;
    }

    function limit($n) {
        $this->queryBuilder .= " LIMIT $n";
        return $this;
    }

    function exec() {
        if (!mysqli_query($this->Connect(), $this->queryBuilder)) {
            echo "Error: " . $this->queryBuilder . "<br>" . mysqli_error($this->mysqli);
        } 
    }

    function stored_proc($sp) {
        $result = $this->mysqli->query("CALL $sp");

        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);

            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            return $data;
            
        } else {
            echo "Error: " . $this->mysqli->error;
        }

        $this->mysqli->close();
    }

    function get() {
        try {
            $result = mysqli_query($this->Connect(), Sanitize($this->queryBuilder));

            if (!$result) {
                die(mysqli_error($this->Connect()));
            }
    
            if (mysqli_num_rows($result) > 0) {

                if(str_contains($this->queryBuilder, "COUNT")) {
                    $data = mysqli_fetch_assoc($result);
                    return $data[array_key_first($data)];
                 }
    
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }

                if (mysqli_num_rows($result) == 1) {
                    return $data[0];
                }
                
                return $data;
            } 
        }

        catch(Exception $e) {
            throw new Exception("Error querying database. " . $e);
        }
    }

}