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
$tb = 'subscriptions';

// Instantiate model object
$subscription = new Model($db, $tb);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize the data
$data = $subscription->sanitize($data);

// Initialize create parameters
$column = "plan, details, price, duration, duration_type, user_id";
$value = ":plan, :details, :price, :duration, :duration_type, :user_id";

    // Create subscription
$response = $subscription->create($column,$value,$data);

$id = $subscription->getLastId();

echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $subscription->readSingleRecord("id=:id", ["id"=>$id], "plan, details, price, duration, duration_type, id, user_id")]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
