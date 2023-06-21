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
$tb = 'users';

// Instantiate model object
$user = new Model($db, $tb);

if ($_SERVER['REQUEST_METHOD'] === "POST") {	
	$data = json_decode(file_get_contents("php://input"), true);
	extract($data);

	if (isset($email)) {
		$response = $user->readSingleRecord("email=:email", ['email' => $email], "id, username, password, email, firstname, lastname, position, department, address, phone, facebook, linkedin, twitter");
		if ($response && password_verify($password, $response['password'])) {
			echo json_encode(["success" => true, "message" => "Successfully logged in", "data" => $response]);
		} else {
			echo json_encode(["success" => false, "message" => "Incorrect Email or Password: Please Enter Correct Details", "data" => null]);
		}
	} else if (isset($username)) {
		$response = $user->readSingleRecord("username=:username", ['username' => $username], "id, username, password, email, firstname, lastname, position, department, address, phone, facebook, linkedin, twitter");
		if ($response && password_verify($password, $response['password'])) {
			echo json_encode(["success" => true, "message" => "Successfully logged in", "data" => $response]);
		} else {
			echo json_encode(["success" => false, "message" => "Incorrect Username or Password: Please Enter Correct Details", "data" => null]);
		}
	}
	
}
?>