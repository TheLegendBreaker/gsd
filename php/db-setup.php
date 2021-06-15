<?php

require 'link.php';

$result = mysqli_query($link, "DROP DATABASE IF EXISTS gsd;", MYSQLI_USE_RESULT);
if($result) {
	echo "`gsd` Database deleted. \n";
}

$sql = "CREATE DATABASE IF NOT EXISTS gsd";

if($link->query($sql) === TRUE) {
	echo "Database created successfully with the name gsd \n";
} else {
	echo "Error creating database: ". $link->error;
}

require 'schema.php';

require 'static-tables.php';

//require 'dummy-data-setup.php';

?>
