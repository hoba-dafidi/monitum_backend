<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once 'config/Database.php';
require_once 'config/Model.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'questions';

// Instantiate model object
$question = new Model($db, $tb);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $form_id = isset($_GET['form_id']) ? $_GET['form_id'] : '';

        // Get question 
        if (!empty($form_id)) {
            $response = $question->readRecords("form_id=:form_id ORDER BY created_on ASC", ["form_id"=>$form_id], "id, question, placeholder, type, required");
            
            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }
    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        extract($data);

        // Initialize parameters
        $column = "question=:question, placeholder=:placeholder, type=:type, required=:required"; 

        $update_data = [
            'id' => $id,
            'question' => $question,
            'placeholder' => $placeholder,
            'type' => $type,
            'required' => $required
        ];

        // Update question
        $response = $question->update($column,"id=:id",$update_data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
  
    break;

    case 'DELETE':
        $id = $_GET['id'];
        
        $response = $question->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    default:
    break;
}