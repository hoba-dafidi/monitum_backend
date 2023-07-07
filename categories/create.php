<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once '../config/Database.php';
require_once '../config/Model.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'categories';

// Instantiate model object
$category = new Model($db, $tb);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"), true);

// Check the data validity
if (count($data) === 0) :
    http_response_code(204);
    echo json_encode(["success" => false, "message" => "Content is empty", "data" => null]);
endif;
if (!isset($data['name']) || !isset($data['user_id'])) :
    http_response_code(406);
    echo json_encode(["success" => false, "message" => "No field should be empty", "data" => $data]);
endif;

// Sanitize the data
$data = $category->sanitize($data);

// Initialize create parameters
$column = "name, user_id";
$value = ":name, :user_id";
$response = $err = '';    
    // Create category
    try {
        $response = $category->create($column,$value,$data);
    } catch (\Throwable $th) {
        $err = $th->getMessage();
    }

if ($response):
    http_response_code(201);
    echo json_encode(["success" => true, "message" => "Successful", "data" => null]);
else:
    http_response_code(501);
    echo json_encode(["success" => false, "message" => $err, "data" => null]);
endif;
