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
$tb = 'subscriptions';

// Instantiate model object
$subscription = new Model($db, $tb);
      
        // Get info from URL
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

        // Get subscription 
        if (!empty($user_id)) {
            $response = $subscription->readRecords("user_id=:user_id ORDER BY created_on ASC", ["user_id"=>$user_id], "id, plan, details, price, duration, duration_type");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }
