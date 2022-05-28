<?php

// get all or one entry;
function select_all_from($link, $table, $conditions="", $all_rows=false) {
	// update to use an $all boolean variable
	if($conditions == ""){
		// get all if there are no condtions
		$sql_fetch = "mysqli_fetch_all";
	} elseif($all_rows==true){
		// get all if there are condtions
		// and format conditions
		$conditions = " ". $conditions;
		$sql_fetch = "mysqli_fetch_all";
	}else {
		$conditions = " ". $conditions;
		$sql_fetch = "mysqli_fetch_row";
	}
	$result = mysqli_query($link, "SELECT * FROM ".$table. $conditions.";", MYSQLI_USE_RESULT);
	if($result) {
		$rows = $sql_fetch($result);
		return $rows;
	}
	return false;
}

// update an entry
function update_set($link, $table, $update_query) {
	$result = mysqli_query($link, "UPDATE ".$table." SET ".$update_query.";", MYSQLI_USE_RESULT);
	if($result) {
		return true;
	}
		return false;
}

// create an entry
function insert_into($link,$table,$feilds,$values) {
	$q_string = "INSERT INTO ".$table." (updated, ".$feilds.") VALUES (NOW(), ".$values.");";
	//return $q_string;
	$result = mysqli_query($link, $q_string, MYSQLI_USE_RESULT);
	if($result) {
		return true;
	}
		return false;
}

// delete an entry
function delete_from($link, $table, $id) {
	$result = mysqli_query($link, "DELETE FROM `".$table."` WHERE ".$table.".id='".$id."';", MYSQLI_USE_RESULT);
	if($result) {
		return true;
	}

		return false;
}

