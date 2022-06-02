<?php

// get all goals
function get_all($link) {
	include '../crud_lib.php';
	include '../app_lib.php';
	include '../request_lib.php';
	$response = array( "result" => get_all_goals($link));
	return json_encode( $response );
};

// get gaol by id
Route::add('/goal/([0-9]*)', function($id) {

	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");
	
	include './link.php';
	$response = array( "result" => get_goal($link,$id));
	return json_encode( $response );
	//return $id;

}, 'get');

// get gaol by criteria
Route::add('/goal/([a-z-0-9-]*)/([a-z-0-9-]*)', function($field,$value) {
	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");
	
	$criteria = array($field=>$value);
	include './link.php';
	$response = array( "result" => get_goal_by($link,$criteria));
	return json_encode( $response );
	//return $id;

}, 'get');

// update goal
Route::add('/goal/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		if(isset($data["label"])) {
			include 'link.php';
			//return 'update '.$id;
			$req_item = array(
				"result" => update_goal($link,$id,$data),
?>
