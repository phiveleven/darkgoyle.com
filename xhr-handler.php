<? 
$origin = $_SERVER["HTTP_ORIGIN"];
if ($origin or $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    header('Content-type: application/json; charset=utf-8');
    // CORS http://enable-cors.org/
		header("Access-Control-Allow-Origin: $origin/".$first_byte); 
    
    global $auth;
    if (!$auth) { echo '{ "status":"401 Unauthorized" }'; exit; }
    
    $path = $_SERVER['REQUEST_URI'];
    $location = explode('/', preg_replace('/^\//', '', $path));
    $table = $location[0];
    $id = $location[1];
    
    
    $response = array( 
            //server => $_SERVER,
            status => "200 OK",
            path => $path,
            location => $location);
    
    // <db>
    include 'db-config.php';
    $dsn = 'mysql:charset=utf8'.
    		  ';host='.DbConfig::HOST.
    			';port='.DbConfig::PORT.
    			';dbname='.DbConfig::DBNAME;
    try { $pdo = new PDO($dsn, DbConfig::USER, DbConfig::PASSWORD); }
    catch (PDOException $e) { die($e->getMessage()); }
    
    try {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
            	  // (if read allowed for user)
                $statement = $pdo->prepare("SELECT * FROM $table WHERE id = :id");
                $response['success'] = 
                	$statement->execute(array(':id' => $id));
                if ($error = $statement->errorInfo())
                	$response['error'] = $error[2];
                
                $response['data'] = array();
                foreach ($statement as $row)
                    $response['data'] = json_decode($row['data'], true);
                break;
                
            case 'POST':
            	  // (if post enabled for user)
                $data = $_POST;
                $data_json = json_encode($data);
                
                $statement = $pdo->prepare("
                		INSERT INTO $table (id, data)
                		VALUES (?,?)
                		ON DUPLICATE KEY UPDATE data = ?
                ");
                $response['success'] = 
                	$statement->execute(array($id, $data_json, $data_json));
                if ($error = $statement->errorInfo())
                	$response['error'] = $error[2];
                
                $response['data'] = $data;
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