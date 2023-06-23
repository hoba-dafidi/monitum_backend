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
$tb = 'user_types';

// Instantiate model object
$user_type = new Model($db, $tb);

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
    