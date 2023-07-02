<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once '../config/Database.php';
require_once '../config/Model.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
// $tb = 'clients';
$tb = 'users';

// Instantiate model object
$client = new Model($db, $tb);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
	$data = json_decode(file_get_contents("php://input"), true);
	if (!empty($data) && is_array($data)) {
		extract($data);

		if (isset($email)) {
			$response = $client->readSingleRecord("email=:email", ['email' => $email], "id, password, email");

			if ($response && password_verify($password, $response['password'])) {
				// $res = [];
				// foreach ($response as $key => $value) {
				// 	if ($key != 'password') {						
				// 		$res[$key] = $value;
				// 	}
				// }
				http_response_code(202);
				echo json_encode(["success" => true, "message" => "Successfully logged in", "data" => $client->readSingleRecord("email=:email", ['email' => $email], "id, username, email, firstname, lastname, organisation, department, user_id, is_client")]);
			} else {
				http_response_code(401);
				echo json_encode(["success" => false, "message" => "Incorrect Email or Password: Please Enter Correct Details", "data" => null]);
			}
		} else {
			http_response_code(400);
		}

		if (isset($username)) {
			$response = $client->readSingleRecord("username=:username", ['username' => $username], "id, username, password");
			if ($response && password_verify($password, $response['password'])) {
				http_response_code(202);
				echo json_encode(["success" => true, "message" => "Successfully logged in", "data" => $client->readSingleRecord("email=:email", ['email' => $email], "id, username, email, firstname, lastname, organisation, department, user_id, is_client")]);
			} else {
				http_response_code(401);
				echo json_encode(["success" => false, "message" => "Incorrect Username or Password: Please Enter Correct Details", "data" => null]);
			}
		} else {
			http_response_code(400);
		}
	} else {
		http_response_code(400);
	}
}
