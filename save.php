<?php
include_once 'class_dbMain_conn.php';
$dbMain_conn=new dbMain_conn();
$mysqli=$dbMain_conn->create_link();

include_once 'class_timewatch_db.php';
$timewatch=new timewatch_db($mysqli);

if(isset($_POST['enter'])){
    $timewatch->saveLine(true, $_POST['lat'], $_POST['long']);
}
else {
    $timewatch->saveLine(false, $_POST['lat'], $_POST['long']);
}

?>
thanks
<br/>
<a href="index.php">report again</a>
<br/>
<br/>
<a href="show.php">my history</a>

