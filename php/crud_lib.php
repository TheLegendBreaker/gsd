<?php
include './query_lib.php';

// project table

function get_all_projects($link) {
	$rows = select_all_from($link, "project");
	if($rows) {
		$req_items = array();

		foreach ($rows as &$value) {
			$project = array(
				"id" => $value[0],
				"entered" => $value[1],
				"updated" => $value[2],
				"label" => $value[3],
			);
			array_push($req_items, $project);
		}
		return $req_items;
	}
		return $rows;
}

function get_project($link, $id) {
	// returns a project
	$conditions = "WHERE project.id='".$id."'";
	$row = select_all_from($link, "project", $conditions);
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

function update_project($link, $project) {
	$update_query = "label='".$project["label"]."' WHERE id = '".$project["id"]."'";
	$row = update_set($link, 'project', $update_query);
	if($row) {
		return $row;
	}
		return false;
}

function create_project($link, $project) {
	$fields = 'label';
	//$values = strval($project);
	$values = $project;

	$row = insert_into($link, 'project', $fields, $values);
	if($row) {
		return true;
	}
		return false;
}

function delete_project($link, $id) {
	$result = delete_from($link, 'project', $id);
	if($result) {
		return true;
	}
		return false;
}

// end project table
// item table

function get_all_tasks($link) {
	// returns all tasks
	$rows = select_all_from($link, "task");
	if($rows) {
		$req_tasks = array();

		foreach ($rows as &$value) {
			$task = array(
				"id" => $value[0],
				"statusId" => $value[1],
				"entered" => $value[2],
				"updated" => $value[3],
				"desc" => $value[4],
			);
			array_push($req_items, $task);
		}
		return $req_items;
	}
		return $rows;
}

function get_task($link,$id) {
	// returns a task
	$conditions = "WHERE task.id='".$id."'";
	$row = select_all_from($link, "task", $conditions);
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

function get_task_by_project($link,$id) {
	// returns a task
	//get_project($link,$id)
	$row = select_all_from($link, "task", $conditions);
	if($row) {

		$req_task = array(
			"id" => $row[0],
			"statusId" => $row[1],
			"entered" => $row[2],
			"updated" => $row[3],
			"desc" => $row[4],
		);
		return json_encode( $req_task );
	}
		return false;
}

function update_task($link,$task) {
	$update_query = "task='".$task["task"]."' WHERE id = '".$task["id"]."'";
	$row = update_set($link, 'task', $update_query);
	if($row) {
		return $row;
	}

		return false;
}

function create_task($link,$task) {
	$fields = 'task, status_id';
	$values = "'".$task."'".",'1'";
	return insert_into($link, 'task', $fields, $values);
}

function delete_task($link, $id) {
	$result = delete_from($link, 'task', $id);
	if($result) {
		return true;
	}
		return false;
}

// end task table
// review_items

function get_review_item() {
	// returns a review_item
}

function get_review_items() {
	// returns all review_item
}

function update_review_item() {
	// updates a review_item's label w/ opt to add review_items to review_item
	// returns boolean for successfull update
}

function create_review_item() {
	// creates a review_item
	// returns boolean for successfull creation
}

function delete_review_item() {
	// deletes a review
	// returns boolean for successfull creation
}

// end review_items
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
				"projectId" => $value[1],
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
			"projectId" => $row[1],
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
				"projectId" => $value[1],
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

function get_task_status() {
	// returns a task_status
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

function get_inbox() {
	// returns all items w/o projects in order of oldest item first.
}

function get_weekly_review() {
	// returns all goals, review_items, and the latest reviews and goal reviews.
}
