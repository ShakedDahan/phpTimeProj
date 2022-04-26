<?php
include_once 'class_dbMain_conn.php';
$dbMain_conn=new dbMain_conn();
$mysqli=$dbMain_conn->create_link();

include_once 'class_timewatch_db.php';
$timewatch=new timewatch_db($mysqli);

$startDate='';
$endDate='';
$data=$timewatch->getHistory($startDate, $endDate);

?>
<html>
    <head>
        <style>
            tr:nth-child(even) td{
                background-color: #c0c0c0;
            }
            td,th{
                border: 1px solid black;
            }
            th{
                background-color: yellow;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th colspan="3">enter</th>
                <th colspan="3">leave</th>
            </tr>
            <tr>
                <th>time</th>
                <th>lat</th>
                <th>long</th>
                <th>time</th>
                <th>lat</th>
                <th>long</th>
            </tr>
            <?php
            foreach ($data as $id => $line) {
                echo "<tr>";
                echo "<td>".$line['enter_time']."</td>";
                echo "<td>".$line['enter_lat']."</td>";
                echo "<td>".$line['enter_long']."</td>";
                echo "<td>".$line['leave_time']."</td>";
                echo "<td>".$line['leave_lat']."</td>";
                echo "<td>".$line['leave_long']."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
