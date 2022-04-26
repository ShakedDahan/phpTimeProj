<?php
include_once 'class_dbMain_conn.php';
$dbMain_conn=new dbMain_conn();
$mysqli=$dbMain_conn->create_link();

include_once 'class_timewatch_db.php';
$timewatch=new timewatch_db($mysqli);

$way=$timewatch->getDirection();

?>
<html>
    <body>
        <form action="save.php" method="post">
            <input type="hidden" name="lat" id="lat_inp" value="" />
            <input type="hidden" name="long" id="long_inp" value="" />
            <?php
            if($way=="enter"){
                echo '<button name="enter"> enter </button>';
            }
            else {
                echo '<button name="leave"> leave </button>';
            }
            ?>
            
        </form>
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition,showError);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            }
            function showError(error) {
                switch(error.code) {
                    case error.PERMISSION_DENIED:
                        alert("User denied the request for Geolocation.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Location information is unavailable.");
                        break;
                    case error.TIMEOUT:
                        alert("The request to get user location timed out.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("An unknown error occurred.");
                        break;
                }
            }
            function showPosition(position) {
                var lat=document.getElementById("lat_inp");
                lat.value= position.coords.latitude; 
                var long=document.getElementById("long_inp");
                long.value= position.coords.longitude; 
                console.log(lat,long);
            }
 
            getLocation();
        </script>
    </body>
</html>