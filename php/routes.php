<?php
// Require the class
include 'route.php';
include 'crud_lib.php';
include 'app_lib.php';
include 'request_lib.php';

// Use this namespace
use GSD\Route;

// helper functions

function format_value_string($value) {
	return "'".$value."'";
}

// varables

$version_name  = 'api/';
$version_number = 'v1/';
$version = $version_name.''.$version_number;
//$version = 'api/v1/';

// set up the dev env with this route
Route::add('/', function() {

	exec ("php /app/db-setup.php",$result);
	$result = var_dump($result);

	print_r($result);

	}, 'get');

Route::add('/item', function() {

		include './link.php';

		$response = array( "result" => get_all_items($link));
		return json_encode( $response );

	}, 'get');

// end dev env set up
// item routes

// create an item
Route::add('/item', function() {
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	if(isset($data["item"])) {
		$item = $data["item"];
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		$response = array( "result" => create_inbox_entry($item));
	mysqli_close($link);
		return json_encode( $response );
	}
	$response = array("result"=>"false");
	return json_encode( $response );
}, 'post');

// get item by id
Route::add('/item/([0-9]*)', function($id) {
	include 'link.php';
	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");
	// also formats the status from an id to the status's label
	// can also return an item's project if it's not the inbox
	return get_item($link,$id);
}, 'get');


Route::add('/item/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		if(isset($data["item"])) {
			include 'link.php';
			$req_item = array(
				"result" => update_item($link,$data),
			);
			return json_encode( $req_item );
		}
	}
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin : http://build.hectordiaz.pro");
		header("Access-Control-Allow-Credentials : true");
		header("Access-Control-Allow-Methods : PUT");
		header("Access-Control-Allow-Headers : *");
		return;
	}
}, ['PUT','OPTIONS']);

Route::add('/item/([0-9]*)/update', function($id) {
	include 'link.php';
	$_POST['id'] = $id;
	$req_item = array(
		"result" => update_item($link,$data),
	);
	return json_encode( $req_item );
}, 'POST');

Route::add('/item/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		include 'link.php';
		delete_item($link,$id);
		$req_item = array(
			"id" => "sucess",
		);
		return json_encode( $req_item );
	}
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin : http://build.hectordiaz.pro");
		header("Access-Control-Allow-Credentials : true");
		header("Access-Control-Allow-Methods : DELETE");
		header("Access-Control-Allow-Headers : *");
		return;
	}
}, ['DELETE','OPTIONS']);

// end item routes
// project routes

// create a project
Route::add('/project', function() {
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	if(isset($data["project"])) {
		include './link.php';
		$project = format_value_string($data["project"]);
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		$response = array( "result" => create_project($link,$project));
		return json_encode( $response );
	}
	$response = array("result"=>"false");
	return json_encode( $response );
	}, 
'post');

Route::add('/project', function() {
		include './link.php';
		$response = array( "result" => get_all_projects($link));
		return json_encode( $response );
	}, 'get');

Route::add('/project/([0-9]*)', function($id) {
	include 'link.php';
	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");
	$req_project = array(
		"result" => get_project($link,$id),
	);
	return json_encode( $req_project );
}, 'get');

Route::add('/project/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		if(isset($data["label"])) {
			$data["id"]=$id;
			include 'link.php';
			$req_project = array(
				"result" => update_project($link,$data),
			);
			return json_encode( $req_project );
		}
	}
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin : http://build.hectordiaz.pro");
		header("Access-Control-Allow-Credentials : true");
		header("Access-Control-Allow-Methods : PUT");
		header("Access-Control-Allow-Headers : *");
		return;
	}
}, ['PUT','OPTIONS']);

Route::add('/project/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");

		include 'link.php';

		delete_project($link,$id);
		$req_project = array(
			"id" => "sucess",
		);
		return json_encode( $req_project );
	}
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin : http://build.hectordiaz.pro");
		header("Access-Control-Allow-Credentials : true");
		header("Access-Control-Allow-Methods : DELETE");
		header("Access-Control-Allow-Headers : *");
		return;
	}

}, ['DELETE','OPTIONS']);

// end project routes
// goal routes

// get all goals
Route::add('/goal', function() {

		include './controller/goal_controller.php';
		include './link.php';

		//return get_all($link);
		$response = array( "result" => get_all_goals($link));
		return json_encode( $response );

}, 'get');

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
			);
			return json_encode( $req_item );
		}
	}
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		header("Access-Control-Allow-Methods : PUT");
		header("Access-Control-Allow-Headers : *");
		return;
	}
}, ['PUT','OPTIONS']);

// create goal
Route::add('/goal', function() {
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	if(isset($data["goal"])) {
		include 'link.php';
		$goal = $data["goal"];
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		$response = array( "result" => create_goal($link, $goal));
		//mysqli_close($link);
		return json_encode( $response );
	}
	$response = array("result"=>"data not valid");
	return json_encode( $response );
}, 'post');

// delete goal by id
Route::add('/goal/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		include 'link.php';
		delete_goal($link,$id);
		$req_item = array(
			"id" => "sucess",
		);
		return json_encode( $req_item );
	}
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		header("Access-Control-Allow-Methods : DELETE");
		header("Access-Control-Allow-Headers : *");
		return;
	}
}, ['DELETE','OPTIONS']);
Route::run('/'.$version);
?>
