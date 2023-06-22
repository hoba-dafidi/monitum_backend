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
$tb = 'subscribers';

// Instantiate model object
$subscriber = new Model($db, $tb);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize the data
$data = $subscriber->sanitize($data);

// Initialize create parameters
$column = "subscription_id, payment_method, transcation_ref, created, expires, user_id";
$value = ":subscription_id, :payment_method, :transcation_ref, :created, :expires, :user_id";
    
// Create subscriber
$response = $subscriber->create($column,$value,$data);

$id = $subscriber->getLastId();

echo $response ? json_encode(["success" => true, "message" => "Successful", "data" =>$subscriber->readSingleRecord("id=:id", ["id"=>$id], "id, subscription_id")]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

// echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
