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
$tb1 = 'forms';
$tb2 = 'questions';

// Instantiate model object
$form_instance = new Model($db, $tb1);
$question_instance = new Model($db, $tb2);

        // Get raw posted data
        $post_data = json_decode(file_get_contents("php://input"), true);
        extract($post_data);

        // Initialize create parameters
        $res2 = [];
        $q_column = "question, placeholder, type, required, form_id";
        $q_value1 = ":question, :placeholder, :type, :required, :form_id";
        $column = "name, category, receive, send, user_id";
        $fvalue = ":name, :category, :receive, :send, :user_id";

         
        $f_data = [
            "name" => $name,
            "category" => $category,
            "receive" => $recieve,
            "send" => $send,
            "user_id" => $user_id
        ];
        
        $response1 = $form_instance->create($column,$fvalue,$f_data);
        $form_id = $form_instance->getLastId();


        foreach ($questions as $q_value) {
            $q_data = [
                "question" => $q_value['question'],
                "placeholder" => $q_value['placeholder'],
                "type" => $q_value['type'],
                "required" => $q_value['required'],
                "form_id" => $form_id
            ];

            
            // Create response
            $response2 = $question_instance->create($q_column,$q_value1,$q_data);

           
            // echo $response1 ? json_encode('Successful: r1') : json_encode('Not Successful');

            // echo $response2 ? json_encode('Successful: r2') : json_encode('Not Successful');
            
        }

        echo $response1 && $response2 ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
