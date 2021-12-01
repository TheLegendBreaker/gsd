<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include 'link-creds.php';
//$password = getenv('GSD_DB_PASSWORD');

if (function_exists('mysqli_connect')){
	$link = mysqli_connect($servername, $username, $password, $db);
}else {
	die("connection failed: mysqli not available");
}

if (!$link) {
	die("connection failed: ".mysqli_connect_error());
}

?>
