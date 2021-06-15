<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "db:3306";
$username = "gsd_php";
$password = "pUcn1,d6beezubxQx";
$db = "gsd";
//$servername = getenv('MYSQL_HOST');
//$username = getenv('MYSQL_USER');
//$password = getenv('MYSQL_PASSWORD');

$link = mysqli_connect($servername, $username, $password, $db);

if (!$link) {
	die("connection failed:".mysqli_connect_error());
}

//echo "Connected successfully \n";
?>
