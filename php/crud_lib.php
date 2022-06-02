<?php
include './query_lib.php';

// tag table

function get_all_tags($link) {
	$rows = select_all_from($link, "tag");
	if($rows) {
		$req_items = array();

		foreach ($rows as &$value) {
			$tag = array(
				"id" => $value[0],
				"entered" => $value[1],
				"updated" => $value[2],
				"label" => $value[3],
			);
			array_push($req_items, $tag);
		}
		return $req_items;
	}
		return $rows;
}

function get_tag($link, $id) {
	// returns a tag
	$conditions = "WHERE tag.id='".$id."'";
	$row = select_all_from($link, "tag", $conditions);
	if($row) {

		$req_item = array(
			"id" => $row[0],
			"entered" => $row[1],
			"updated" => $row[2],
			"label" => $row[3],
		);
		return $req_item;
	}
		return false;
}

function update_tag($link, $tag) {
	$update_query = "label='".$tag["label"]."' WHERE id = '".$tag["id"]."'";
	$row = update_set($link, 'tag', $update_query);
	if($row) {
		return $row;
	}
		return false;
}

function create_tag($link, $tag) {
	$fields = 'label';
	//$values = strval($tag);
	$values = $tag;

	$row = insert_into($link, 'tag', $fields, $values);
	if($row) {
		return true;
	}
		return false;
}

function delete_tag($link, $id) {
	$result = delete_from($link, 'tag', $id);
	if($result) {
		return true;
	}
		return false;
}

// end tag table
// item table

function get_all_items($link) {
	// returns all items
	$rows = select_all_from($link, "item");
	if($rows) {
		$req_items = array();

		foreach ($rows as &$value) {
			$item = array(
				"id" => $value[0],
				"statusId" => $value[1],
				"entered" => $value[2],
				"updated" => $value[3],
				"desc" => $value[4],
			);
			array_push($req_items, $item);
		}
		return $req_items;
	}
		return $rows;
}

function get_item($link,$id) {
	// returns a item
	$conditions = "WHERE item.id='".$id."'";
	$row = select_all_from($link, "item", $conditions);
	if($row) {

		$req_item = array(
			"id" => $row[0],
			"statusId" => $row[1],
			"entered" => $row[2],
			"updated" => $row[3],
			"desc" => $row[4],
		);
		return json_encode( $req_item );
	}
		return false;
}

function get_item_by_tag($link,$id) {
	// returns a item
	//get_tag($link,$id)
	$row = select_all_from($link, "item", $conditions);
	if($row) {

		$req_item = array(
			"id" => $row[0],
			"statusId" => $row[1],
			"entered" => $row[2],
			"updated" => $row[3],
			"desc" => $row[4],
		);
		return json_encode( $req_item );
	}
		return false;
}

function update_item($link,$item) {
	$update_query = "item='".$item["item"]."' WHERE id = '".$item["id"]."'";
	$row = update_set($link, 'item', $update_query);
	if($row) {
		return $row;
	}

		return false;
}

function create_item($link,$item) {
	$fields = 'item, status_id';
	$values = "'".$item."'".",'1'";
	return insert_into($link, 'item', $fields, $values);
}

function delete_item($link, $id) {
	$result = delete_from($link, 'item', $id);
	if($result) {
		return true;
	}
		return false;
}

// end item table
function get_priority() {
}

function get_all_priorities_by_tag() {
	// returns all priority that match 
}

function update_priority() {
	// updates a priority's label w/ opt to add prioritys to priority
	// returns boolean for successfull update
}

function create_priority() {
	// creates a priority
	// returns boolean for successfull creation
}

function delete_priority() {
	// deletes a priority
	// returns boolean for successfull creation
}

function get_backlog_item($link, $id) {
	$conditions = "WHERE backlog_item.item_id='".$id."'";
	$row = select_all_from($link, "backlog_item", $conditions);
	if($row) {

		$req_item = array(
			"id" => $row[0],
			"tag" => $row[1],
			"item" => $row[2],
			"entered" => $row[3],
			"updated" => $row[4],
		);
		return json_encode( $req_item );
	}
		return false;
}

function get_all_backlog_items($link) {
	$rows = select_all_from($link, "backlog_item");
	if($rows) {
		$req_items = array();
		foreach ($rows as &$value) {
			$item = array(
				"item" => $value[0],
				"tag" => $value[1],
				"priority" => $value[2],
				"entered" => $value[3],
				"updated" => $value[4]
			);
			array_push($req_items, $item);
		}
		return $req_items;
	}
		return $rows;
}

function update_backlog_item($link, $id, $item) {
	$update_query = "item_id='".$item["item"]."' WHERE id = '".$id."'";
	$row = update_set($link, 'backlog_item', $update_query);
	if($row) {
		return $row;
	}
		return false;
}

function update_backlog_item_tag($link, $id, $tag) {
	$update_query = "tag_id='".$tag["tag"]."' WHERE id = '".$id."'";
	$row = update_set($link, 'backlog_item', $update_query);
	if($row) {
		return $row;
	}
		return false;
}

function create_backlog_item($link,$values) {
	$fields = 'item_id, tag_id, rank_order';
	return insert_into($link, 'backlog_item', $fields, $values);
}

function delete_backlog_item($link, $id) {
	$result = delete_from($link, 'backlog_item', $id);
	if($result) {
		return true;
	}
		return false;
	// returns boolean for successfull creation
}
// end backlog_item
// reviews

function get_reviews() {
	// returns a review
}

function update_review() {
	// updates a review's label w/ opt to add reviews to review
	// returns boolean for successfull update
}

function create_review() {
	// creates a review
	// returns boolean for successfull creation
}

function delete_review() {
	// deletes a review
	// returns boolean for successfull creation
}

// end reviews
// goal reviews

function get_goal_reviews() {
	// returns a goal_review
}

function update_goal_review() {
	// updates a goal_review's label w/ opt to add goal_reviews to goal_review
	// returns boolean for successfull update
}

function create_goal_review() {
	// creates a goal_review
	// returns boolean for successfull creation
}

function delete_goal_review() {
	// deletes a goal_review
	// returns boolean for successfull creation
}

function create_goal($link, $goal) {
	//$fields = 'label, done_def, done';
	$fields = 'label, status_id, limit_id, done_def, done';
	$status_id = isset($goal['status_id']) ? "'".$goal['status_id']."'" : "(SELECT id FROM status WHERE label='open')";
	$wip_limit = isset($goal['wip_limit']) ? "'".$goal['wip_limit']."'" : "(SELECT id FROM wip_limit WHERE time_limit='2 hour')";
	$values = "'".$goal['label']."', ".$status_id.", ".$wip_limit.", '".$goal['done_def']."', false";

	$row = insert_into($link, 'goal', $fields, $values);
	if($row) {
		return $row;
	}
	return "no row returned. ".$row;
}

function get_all_goals($link) {
	$rows = select_all_from($link, "goal");
	if($rows) {
		$req_items = array();

		foreach ($rows as &$value) {
			$item = array(
				"id" => $value[0],
				"tagId" => $value[1],
				"limitId" => $value[2],
				"statusId" => $value[3],
				"entered" => $value[4],
				"updated" => $value[5],
				"label" => $value[6],
				"done" => $value[8],
			);
			array_push($req_items, $item);
		}
		return $req_items;
	}
		//return $rows;
		return 'no rows';
}

function get_goal($link, $id) {
	// returns a goal
	$conditions = "WHERE goal.id='".$id."'";
	$row = select_all_from($link, "goal", $conditions);
	if($row) {

		$req_item = array(
			"id" => $row[0],
			"tagId" => $row[1],
			"limitId" => $row[2],
			"statusId" => $row[3],
			"entered" => $row[4],
			"updated" => $row[5],
			"label" => $row[6],
		);
		return $req_item;
	}
		return false;
}

function get_goal_by($link, $criteria) {
	// returns a goal
	$conditions = "WHERE ";
	foreach($criteria as $key => $value) {
		if(is_string($value)){
			$conditions .= "goal.".$key."='".$value."'";
		}
		else {
			$conditions .= "goal.".$key."=".$value;
		}
	}

	$rows = select_all_from($link, "goal", $conditions, $all_rows=true);
	if($rows) {

		$req_items = array();

		foreach ($rows as &$value) {
			$item = array(
				"id" => $value[0],
				"tagId" => $value[1],
				"limitId" => $value[2],
				"statusId" => $value[3],
				"entered" => $value[4],
				"updated" => $value[5],
				"label" => $value[6],
			);
			array_push($req_items, $item);
		}
		return $req_items;
	}
		return false;
}
function update_goal($link, $id, $goal) {
	// updates a goal's label w/ opt to add goals to goal

	$update_query = "";
	foreach($goal as $key => $value) {
		if(is_string($value)){
			$update_query .= $key."='".$value."'";
		}
		else {
			$update_query .= $key."=".$value;
		}
	}
	$update_query .= " WHERE id = '".$id."'";
	$row = update_set($link, 'goal', $update_query);
	if($row) {
		return $row;
	}
		return false;
	// returns boolean for successfull update
}

function delete_goal($link, $id) {
	$result = delete_from($link, 'goal', $id);
	if($result) {
		return true;
	}
		return false;
}

function get_item_statuses() {
	// returns a item_status
}

function get_item_status() {
	// returns a item_status
}

function get_goal_status() {
	// returns a goal_status
}

function get_all_review_items() {
	// returns a review_item
}

function get_review_item() {
	// returns a review_item
}

function get_all_wip_timelimits() {
	// returns a wip_timelimit
}

function get_wip_timelimit() {
	// returns a wip_timelimit
}

function get_backlog_by_tag() {
// returns all backlog items by tag
}

function get_inbox() {
	// returns all items w/o tags in order of oldest item first.
}

function get_weekly_review() {
	// returns all goals, review_items, and the latest reviews and goal reviews.
}
