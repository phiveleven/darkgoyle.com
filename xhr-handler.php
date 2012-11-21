<? if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
	header('Content-type: application/json; charset=utf-8');
	$path = $_SERVER['REQUEST_URI'];
	global $auth;
	if (!$auth) { echo '{ "status":"401 Unauthorized" }'; exit; }
	
	$response = array( 
			//server => $_SERVER,
			status => "200 OK",
			query => "$path");
	
	echo json_encode($response);
	exit;
}