<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once 'config/Database.php';
require_once 'config/Model.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'user_types';

// Instantiate model object
$user_type = new Model($db, $tb);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $user = isset($_GET['user']) ? $_GET['user'] : '';

        // Get user_type 
        if ($user == 2) {
            $response = $user_type->readRecords("1 ORDER BY created_on ASC", [], "id, name");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }
    break;

    case 'POST':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $user_type->sanitize($data);

        // Initialize create parameters
        $column = "name";
        $value = ":name";
            
            // Create user_type
        $response = $user_type->create($column,$value,$data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $user_type->sanitize($data);
        extract($data);

        // Initialize parameters
        $column = "name=:name";

        $update_data = [
            'id' => $id,
            'name' => $name,
        ];

            // Update user_type
        $response = $user_type->update($column,"id=:id",$update_data);

       echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
  
    break;

    case 'DELETE':
        $id = $_GET['id'];
        
        $response = $user_type->delete("id=:id", ['id' => $id]);

       echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    default:
    break;
}