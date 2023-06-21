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
$tb = 'categories';

// Instantiate model object
$category = new Model($db, $tb);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
        // $id = isset($_GET['id']) ? $_GET['id'] : '';

        // Get category 
        if (!empty($user_id)) {
            $response = $category->readRecords("user_id=:user_id ORDER BY created_on ASC", ["user_id"=>$user_id], "id, name");
            
            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        } 

    break;

    case 'POST':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $category->sanitize($data);

        // Initialize create parameters
        $column = "name, user_id";
        $value = ":name, :user_id";
            
            // Create category
        $response = $category->create($column,$value,$data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $category->sanitize($data);
        extract($data);

        // Initialize parameters
        $column = "name=:name";

        $update_data = [
            'id' => $id,
            'name' => $name,
        ];

            // Update category
        $response = $category->update($column,"id=:id",$update_data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
  
    break;

    case 'DELETE':
        // Delete post
        $id = $_GET['id'];
        
        $response = $category->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        
    break;

    default:
    break;
}