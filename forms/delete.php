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
$tb1 = 'forms';
$tb2 = 'questions';

// Instantiate model object
$form_instance = new Model($db, $tb1);
$question_instance = new Model($db, $tb2);

        $id = $_GET['id'];
        
        $response = $form_instance->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
