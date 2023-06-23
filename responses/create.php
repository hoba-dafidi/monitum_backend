<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once '../config/Database.php';
require_once '../config/Model.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'responses';

// Instantiate model object
$response_instance = new Model($db, $tb);

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
