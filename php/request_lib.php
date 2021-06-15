<?php
function process_put_request(){
	if ($_SERVER['REQUEST_METHOD'] == 'PUT')
	{
		parse_str(file_get_contents("php://input"), $_PUT);

		foreach ($_PUT as $key => $value)
		{
			echo $_PUT;
			echo $key;
			unset($_PUT[$key]);

			$_PUT[str_replace('amp;', '', $key)] = $value;
		}

		$_REQUEST = array_merge($_REQUEST, $_PUT);
	}
}

?>
