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
$tb = 'user_types';

// Instantiate model object
$user_type = new Model($db, $tb);
   
// Get info from URL
$user = isset($_GET['user']) ? $_GET['user'] : '';

// Get user_type 
if ($user == 2) {
    $response = $user_type->readRecords("1 ORDER BY created_on ASC", [], "id, name");

    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

}
