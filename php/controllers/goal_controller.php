<?php
include 'route.php';
include 'crud_lib.php';
include 'app_lib.php';
include 'request_lib.php';
// get all goals
Route::add('/goal', function() {

		include './link.php';

		$response = array( "result" => get_all_goals($link));
		return json_encode( $response );

	}, 'get');
?>
