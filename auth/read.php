<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once '../config/Database.php';
require_once '../config/Model.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'users';
// $tb = 'clients';
$tb2 = 'address';

// Instantiate model object
$client = new Model($db, $tb);

// Get info from URL
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$user = isset($_GET['user']) ? $_GET['user'] : '';

// Get client 
if (!empty($user_id)) {
    $response = $client->joinRecords("id", "user_id", $tb2, "t1.user_id=:user_id", ["user_id" => $user_id], "t1.id, t1.username, t1.password, t1.email, t1.firstname, t1.lastname, t1.organisation, t1.department, t1.phone, t1.logo, t1.user_id, t1.is_client, t2.street, t2.city, t2.state, t2.postal_code, t2.country");

    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
} else if (!empty($user) && $user == 2) {
    $response = $client->joinRecords("id", "user_id", $tb2, "t1.user_id is null", [], "t1.id, t1.username, t1.password, t1.email, t1.firstname, t1.lastname, t1.organisation, t1.department, t1.phone, t1.logo, t1.user_id, t1.is_client, t2.street, t2.city, t2.state, t2.postal_code, t2.country");

    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
}
