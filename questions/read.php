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
$tb = 'questions';

// Instantiate model object
$question = new Model($db, $tb);
    
// Get info from URL
$form_id = isset($_GET['form_id']) ? $_GET['form_id'] : '';

// Get question 
if (!empty($form_id)) {
    $response = $question->readRecords("form_id=:form_id ORDER BY created_on ASC", ["form_id"=>$form_id], "id, question, placeholder, type, required");
    
    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

}
