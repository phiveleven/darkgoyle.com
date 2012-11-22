<? if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
	header('Content-type: application/json; charset=utf-8');
	global $auth;
	if (!$auth) { echo '{ "status":"401 Unauthorized" }'; exit; }
	
	$path = $_SERVER['REQUEST_URI'];
	$location = explode('/', preg_replace('/^\//', '', $path));
	
	$response = array( 
//  			server => $_SERVER,
			status => "200 OK",
			path => $path,
			location => $location);
	
	// <db>
	include 'db-config.php';
	$dsn = 'mysql:host='.DbConfig::HOST.';port='.DbConfig::PORT.';dbname='.DbConfig::DBNAME;
	try {
		$response['data'] = array();
		$pdo = new PDO($dsn, DbConfig::USER, DbConfig::PASSWORD);
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'PUT':
				break;
			case 'DELETE':
				break;
			case 'POST':
				break;
				
			case 'GET':
				$sql = "SELECT * FROM $location[0]";
				$statement = $pdo->prepare($sql);
				$statement->execute();
				foreach ($statement as $row)
					$response['data'][$row['id']] = $row['data'];
				break;
		}
	} 
	catch (Exception $e){
		header(' ', true, 500);
		$response['status'] = '500 Internal Server Error';
		$response['error'] = $e->getMessage();
	}
	// </db>
	
	echo @json_encode($response);
	exit;
}