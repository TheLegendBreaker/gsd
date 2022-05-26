<?php

if(mysqli_select_db($link, "gsd") === TRUE) { $result = mysqli_query($link, "SELECT DATABASE()");
	$row = mysqli_fetch_row($result);
	echo "Database selected successfully with the name ". $row[0] . "\n";
} else {
	echo "Error creating database: ". $connection->error;
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS review_item ( 
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	enterd TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	name VARCHAR(255) NOT NULL
	);", MYSQLI_USE_RESULT);
if($result) {
	echo "`review_item` Table Created. \n";
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS tag ( 
	id INT PRIMARY KEY AUTO_INCREMENT,
	enterd TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	label VARCHAR(255) NOT NULL
	);", MYSQLI_USE_RESULT);
if($result) {
	echo "`tag` Table Created. \n";
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS status ( 
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	enterd TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	label VARCHAR(255) NOT NULL
	);", MYSQLI_USE_RESULT);
if($result) {
	echo "`status` Table Created. \n";
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS review (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	reviewee_id INT NOT NULL,
	reviewed TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	review LONGTEXT NOT NULL,
	FOREIGN KEY (reviewee_id) REFERENCES review_item(id));", MYSQLI_USE_RESULT);
if($result) {
	echo "`review` Table Created. \n";
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS item (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	status_id INT NULL,
	entered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	item LONGTEXT NOT NULL,
	FOREIGN KEY (status_id) REFERENCES status(id));", MYSQLI_USE_RESULT);
if($result) {
	echo "`item` Table Created. \n";
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS wip_limit (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	entered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	time_limit VARCHAR(255) NOT NULL);", MYSQLI_USE_RESULT);
if($result) {
	echo "`wip_limit` Table Created. \n";
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS goal (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	tag_id INT NULL,
	limit_id INT NOT NULL,
	status_id INT NOT NULL,
	entered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	label VARCHAR(255) NOT NULL,
	FOREIGN KEY (tag_id) REFERENCES tag(id),
	FOREIGN KEY (limit_id) REFERENCES wip_limit(id),
	FOREIGN KEY (status_id) REFERENCES status(id));", MYSQLI_USE_RESULT);
if($result) {
	echo "`goal` Table Created. \n";
}

$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS goal_review (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	goal_id INT NOT NULL,
	reviewed TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	review LONGTEXT NOT NULL,
	FOREIGN KEY (goal_id) REFERENCES goal(id));", MYSQLI_USE_RESULT);
if($result) {
	echo "`goal_review` Table Created. \n";
}

	//id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
$result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS backlog_item (
	item_id INT NOT NULL,
	tag_id INT NOT NULL,
	rank_order INT NOT NULL,
	entered TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (tag_id, item_id),
	FOREIGN KEY (tag_id) REFERENCES tag(id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (item_id) REFERENCES item(id) ON DELETE CASCADE ON UPDATE CASCADE);", MYSQLI_USE_RESULT);
if($result) {
	echo "`backlog_item` Table Created. \n";
}

?>
