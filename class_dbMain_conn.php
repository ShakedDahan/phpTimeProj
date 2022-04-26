<?php

class dbMain_conn {
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_schema;
    private $mysqli;

    function __construct() {

        $this->db_host = 'localhost';
        $this->db_user = "root";
        $this->db_pass = '';
        $this->db_schema = "telhai";
    }
    function create_link(){
        //connect to server
        $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_schema);
//        echo "new mysqli({$this->db_host}, {$this->db_user}, {$this->db_pass}, {$this->db_schema}) <br />";
        if(mysqli_connect_errno()) {
            add_error("Connect failed: ".mysqli_connect_error());
            exit();
        }

            //set connection encoding
        if (!$this->mysqli->set_charset("utf8")) {
            add_error("Error loading character set utf8: ", $this->mysqli->error);
        }
        
        return $this->mysqli;
    }

    function close_link(){
        mysqli_close($this->mysqli);        
    }
}
