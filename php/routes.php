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
	// can also return an item's tag if it's not the inbox
	return get_item($link,$id);
}, 'get');

// get item by id
Route::add('/item/tag/([0-9]*)', function($id) {
	include 'link.php';
	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");
	// also formats the status from an id to the status's label
	// can also return an item's tag if it's not the inbox
	return get_item_by_tag($link,$id);
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
// tag routes

// create a tag
Route::add('/tag', function() {
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	if(isset($data["tag"])) {
		include './link.php';
		$tag = format_value_string($data["tag"]);
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		$response = array( "result" => create_tag($link,$tag));
		return json_encode( $response );
	}
	$response = array("result"=>"false");
	return json_encode( $response );
	}, 
'post');

Route::add('/tag', function() {
		include './link.php';
		$response = array( "result" => get_all_tags($link));
		return json_encode( $response );
	}, 'get');

Route::add('/tag/([0-9]*)', function($id) {
	include 'link.php';
	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");
	$req_tag = array(
		"result" => get_tag($link,$id),
	);
	return json_encode( $req_tag );
}, 'get');

Route::add('/tag/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		if(isset($data["label"])) {
			$data["id"]=$id;
			include 'link.php';
			$req_tag = array(
				"result" => update_tag($link,$data),
			);
			return json_encode( $req_tag );
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

Route::add('/tag/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");

		include 'link.php';

		delete_tag($link,$id);
		$req_tag = array(
			"id" => "sucess",
		);
		return json_encode( $req_tag );
	}
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		header("Access-Control-Allow-Origin : http://build.hectordiaz.pro");
		header("Access-Control-Allow-Credentials : true");
		header("Access-Control-Allow-Methods : DELETE");
		header("Access-Control-Allow-Headers : *");
		return;
	}

}, ['DELETE','OPTIONS']);

// end tag routes
// backlog routes

// create a backlog
Route::add('/backlog', function() {
	$data = file_get_contents('php://input');
	$data = json_decode($data, true);
	if(isset($data["item"])) {
		include './link.php';
		$item = $data["item"];
		//$item = format_value_string( $data["item"] );
		$tag = $data["tag"];
		//$tag = format_value_string( $data["tag"] );
		$priority = 0;
		//$priority = "'0'";
		if(isset($data["priority"])){
			$priority = format_value_string( $data["priority"] );
		}
		//$backlog_item = " ". $item .", ". $tag .", ". $priority;
		$backlog_item = "(SELECT id FROM item WHERE id= ". $item ."), (SELECT id FROM tag WHERE id= ". $tag ."), ". $priority;
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");
		$response = array( "result" => create_backlog_item($link,$backlog_item));
		return json_encode( $response );
	}
	$response = array("result"=>"false");
	return json_encode( $response );
	}, 'post'); // Run the router

// get all backlog items
Route::add('/backlog', function() {
		include './link.php';
		$response = array( "result" => get_all_backlog_items($link));
		return json_encode( $response );
	}, 'get');

// get backlog item by item id
Route::add('/backlog/([0-9]*)', function($id) {
	include 'link.php';
	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");
	return get_backlog_item($link,$id);
}, 'get');

// get backlog item by item id
// get backlog item by tag id

// updated backlog item by id
Route::add('/backlog/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		if(isset($data["item"])) {
			include 'link.php';
			$req_item = array(
				"result" => update_backlog_item($link,$id,$data),
			);
			return json_encode( $req_item );
		}
		if(isset($data["tag"])) {
			include 'link.php';
			$req_item = array(
				"result" => update_backlog_item_tag($link,$id,$data),
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

Route::add('/backlog/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");

		include 'link.php';

		delete_backlog_item($link,$id);
		$req_item = array(
			"result" => "sucess",
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

// end backlog routes

Route::run('/'.$version);
?>
