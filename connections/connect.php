<?php
// $sname= "localhost";
// $unmae= "u607598273_root";
// $password = "zO4#xw/p";
// $db_name = "u607598273_mannafest_db";

// $con = mysqli_connect($sname, $unmae, $password, $db_name);

// if (!$con) {
// 	echo "Connection failed!";
// }



$sname= "localhost";
$unmae= "root";
$password = "";
$db_name = "mannafest_db";

$con = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$con) {
	echo "Connection failed!";
}
date_default_timezone_set('Asia/Manila');
?>