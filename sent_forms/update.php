<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: PUT');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once '../config/Database.php';
require_once '../config/Model.php';


// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'sent_forms';

// Instantiate model object
$sent_form = new Model($db, $tb);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"), true);

// Initialize parameters
$column = "status=:status";

$update_data = [
    'id' => $id,
    'status' => $status,
];

// Update sent_form
$response = $sent_form->update($column,"id=:id",$update_data);

echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

