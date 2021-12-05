<?php
// Require the class
include 'route.php';
include 'crud_lib.php';
include 'request_lib.php';

// Use this namespace
use GSD\Route;

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

Route::add('/item', function() {

	$data = file_get_contents('php://input');
	$data = json_decode($data, true);

	if(isset($data["item"])) {
		include './link.php';
		$item = $data["item"];
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");

		$response = array( "result" => create_item($link,$item));
		return json_encode( $response );
	}

	$response = array("result"=>"false");
	return json_encode( $response );

	}, 'post'); // Run the router

Route::add('/item/([0-9]*)', function($id) {
	include 'link.php';

	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");

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
// tag routes

Route::add('/tag', function() {

	$data = file_get_contents('php://input');
	$data = json_decode($data, true);

	if(isset($data["tag"])) {
		include './link.php';
		$tag = $data["tag"];
		header("Access-Control-Allow-Origin : *");
		header("Access-Control-Allow-Credentials : true");

		$response = array( "result" => create_tag($link,$tag));
		return json_encode( $response );
	}

	$response = array("result"=>"false");
	return json_encode( $response );

	}, 'post'); // Run the router

Route::add('/tag', function() {

		include './link.php';

		$response = array( "result" => get_all_tags($link));
		return json_encode( $response );

	}, 'get');

Route::add('/tag/([0-9]*)', function($id) {
	include 'link.php';

	header("Access-Control-Allow-Origin : *");
	header("Access-Control-Allow-Credentials : true");

	return get_tag($link,$id);
}, 'get');

Route::add('/tag/([0-9]*)', function($id) {
	if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);

		if(isset($data["label"])) {

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

Route::run('/');
?>
