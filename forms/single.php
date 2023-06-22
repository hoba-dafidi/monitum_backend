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
$tb1 = 'forms';
$tb2 = 'questions';

// Instantiate model object
$form_instance = new Model($db, $tb1);
     
// Get info from URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Get response 
if (!empty($id)) {
    $response = $form_instance->readRecords("id=:id ORDER BY created_on ASC", ["id"=>$id], "id, name, category, receive, send");

    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

}
