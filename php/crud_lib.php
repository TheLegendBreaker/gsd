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
		return json_encode( $req_item );
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
	$values = strval($tag);
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

function update_item($link,$item) {
	$update_query = "item='".$item["item"]."' WHERE id = '".$item["id"]."'";
	$row = update_set($link, 'item', $update_query);
	if($row) {
		return $row;
	}

		return false;
}

function create_item($link,$item) {
	$fields = 'item';
	$values = strval($item);
	$row = insert_into($link, 'item', $fields, $values);
	if($row) {
		return true;
	}
		return false;
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
	// returns a tag
	$conditions = "WHERE backlog_item.id='".$id."'";
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
				"id" => $value[0],
				"tag" => $value[1],
				"item" => $value[2],
				"entered" => $value[3],
				"updated" => $value[4],
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

function create_backlog_item($link,$item) {
	// need id's from both item and tag
	$fields = 'tag_id, item_id';
	$values = strval($item);
	$row = insert_into($link, 'backlog_item', $fields, $values);
	if($row) {
		return true;
	}
		return false;
	return $values;
}

function delete_backlog_item($link, $id) {
	$result = delete_from($link, 'backlog_item', $id);
	if($result) {
		return true;
	}
		return false;
	// returns boolean for successfull creation
}

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

function get_goals() {
	// returns a goal
}

function get_goal() {
	// returns a goal
}

function update_goal() {
	// updates a goal's label w/ opt to add goals to goal
	// returns boolean for successfull update
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
