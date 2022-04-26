<?php
include_once 'class_dbMain_general.php';
 
class timewatch_db extends dbMain_general  {
    
    public function __construct($mysqli) {
        parent::__construct ($mysqli);
        $this->table="timewatch";
    }
		
    function saveLine($enter=true,$lat='',$long='') {
        $time = date("Y-m-d H:i:s");
        $lat=addslashes($lat);
        $long=addslashes($long);

        if($enter){
            // enter = new line
            $query  = "INSERT INTO ".$this->table;
            $query .= " (enter_time,enter_lat,enter_long,leave_time) ";
            $query .= " VALUES ('$time','$lat','$long','')";
            $result = $this->query($query);
            if(!$result) {
                return false;
            }
            return $this->last_id();
        }
        else {
            // leave = update line
	    $query  = "UPDATE ".$this->table." SET ";
	    $query .= "`leave_time`='$time', ";
	    $query .= "`leave_lat`='$lat', ";
	    $query .= "`leave_long`='$long' ";
	    $query .= " WHERE enter_time IS NOT NULL  AND leave_time=''";
            $result = $this->query($query);
            if(!$result) {
                return false;
            }
            return true;
        }
    }
    public function getDirection(){
        $ret="enter";
        if($this->checkExistsByWhere("enter_time IS NOT NULL  AND leave_time='' ")){
            $ret="leave";
        }
        return $ret;
    }

    public function getHistory($startDate='',$endDate='') {
        $ret = array();

        $query = "SELECT * FROM ".$this->table;
        $wh='';
        if(!empty($startDate)){
            $wh .=" WHERE enter_time >= '$startDate 00:00:00' ";
        }
        if(!empty($endDate)){
            $wh .= (empty($wh))?" WHERE " : " AND ";
            $wh .=" enter_time <= '$endDate 23:59:59' ";
        }
        $query.=" $wh ORDER BY enter_time DESC";

        $result = $this->query($query);
        if(!$result) {
            return false;
        }

        while($row = mysqli_fetch_assoc($result)) {
            $ret[$row['id']]['enter_time'] = stripslashes($row['enter_time']);
            $ret[$row['id']]['enter_lat'] = stripslashes($row['enter_lat']);
            $ret[$row['id']]['enter_long'] = stripslashes($row['enter_long']);
            $ret[$row['id']]['leave_time'] = stripslashes($row['leave_time']);
            $ret[$row['id']]['leave_lat'] = stripslashes($row['leave_lat']);
            $ret[$row['id']]['leave_long'] = stripslashes($row['leave_long']);
        }

        return $ret;
    }

}
/*
CREATE TABLE `telhai`.`timewatch` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`enter_time` VARCHAR( 100 ) NULL ,
`enter_lat` VARCHAR( 100 ) NULL ,
`enter_long` VARCHAR( 100 ) NULL ,
`leave_time` VARCHAR( 100 ) NULL ,
`leave_lat` VARCHAR( 100 ) NULL ,
`leave_long` VARCHAR( 100 ) NULL
) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;


 */