<?php

$result = mysqli_query($link, "INSERT INTO station (updated, name, address) VALUES (NOW(),'eternia station 102','210 castle grayskull, eternia');", MYSQLI_USE_RESULT);
if($result) {
	echo "`station` Entry Created. \n";
}

?>
