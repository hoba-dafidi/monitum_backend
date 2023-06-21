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
$tb = 'responses';

// Instantiate model object
$response_instance = new Model($db, $tb);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $form_id = isset($_GET['form_id']) ? $_GET['form_id'] : '';

        // Get response 
        if (!empty($form_id)) {
            $response = $response_instance->readRecords("form_id=:form_id ORDER BY created_on ASC", ["form_id"=>$form_id], "id, question_id, form_id, response");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }

    break;

    case 'POST':
        // Get raw posted data
        $post_data = json_decode(file_get_contents("php://input"), true);
        extract($post_data);
        
        // Initialize create parameters
        $res = [];
        $q_ids = [];
        $duplicate_ids = [];
        
        $column = "question_id, form_id, response, user_id";
        $value = ":question_id, :form_id, :response, :user_id";
        foreach ($responses as $res_value) {
            extract($res_value);
            $check = $response_instance->readSingleRecord("question_id=:question_id", ['question_id' => $question_id]);
            
            if ($check && $check['question_id'] == $question_id) {                
                $duplicate_ids[] = $question_id;
                // return;
            }

            $data = [
                "question_id" => $question_id,
                "form_id" => $form_id,
                "response" => $response,
                "user_id" => $user_id
            ];
            
            // Create response
            $response = $response_instance->create($column,$value,$data);
            if (!$response) {                
                $res[] = $data["question_id"];
            }
        }

        // if (count($res) > 0) {            
        //     foreach ($duplicate_ids as $value) {                
        //         echo json_encode("Question with id $value was not successfully inserted!"), "\n";
        //     }
        // } else if (count($duplicate_ids) > 0) {
        //     foreach ($duplicate_ids as $value) {                
        //         echo json_encode("Question with id $value already exist"), "\n";
        //     }
        // } else {
            // echo json_encode('Successful');
        // }
        
        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);        
        
    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $response_instance->sanitize($data);
        extract($data);

        // Initialize parameters
        $column = "response=:response";

        $update_data = [
            'id' => $id,
            'response' => $response,
        ];

            // Update response
        $response = $response_instance->update($column,"id=:id",$update_data);


        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
    break;

    case 'DELETE':
        $id = $_GET['id'];
        
        $response = $response_instance->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    default:
    break;
}