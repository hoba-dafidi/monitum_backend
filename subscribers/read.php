<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: GET');
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
     
// Get info from URL
$user_level = isset($_GET['user_level']) ? $_GET['user_level'] : '';

// Get subscriber 
if ($user_level == 1) {
    $response = $subscriber->readRecords("1 ORDER BY created_on ASC", [], "id, user_id, subscription_id, payment_method, transaction_ref, created, expires");

    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

}
