<?php

class dbMain_general {
    public $mysqli;
    public $table;


    //connect to DB
    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }
    public function get_mysqli() {
        return $this->mysqli;
    }
    public function query($sql) {
        $result = mysqli_query($this->mysqli, $sql);
        if(!$result)
            echo "Error in query `$sql`: ".mysqli_error($this->mysqli);

        return $result;
    }    
    public function checkExistsByWhere($wh) {
        $query = 'SELECT * FROM '.$this->table." WHERE $wh ";

        $result = $this->query($query);
        if(!$result) {
            return false;
        }

        return (boolean)mysqli_num_rows($result);
    }
    public function last_id() {
        return mysqli_insert_id($this->mysqli);
    }	
}

