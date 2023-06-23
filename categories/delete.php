<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: DELETE');
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

// Delete post
$id = $_GET['id'];

$response = $category->delete("id=:id", ['id' => $id]);

if ($response):
    http_response_code(200);
    echo json_encode(["success" => true, "message" => "Successful", "data" => null]);
else:
    http_response_code(501);
    echo json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
endif;
