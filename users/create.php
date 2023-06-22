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
$tb = 'users';

// Instantiate model object
$user = new Model($db, $tb);

// Get raw posted data as associative array
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize the data
$data = $user->sanitize($data);

if (isset($data['user_id'])) {    
    $response = $user->readSingleRecord("email=:email OR username=:username OR phone=:phone", ['email' => $data['email'], 'username' => $data['username'], 'phone' => $data['phone']]);

    if ($response && count($response) > 0) {
        if ($response['email'] == $data['email']) {                
            echo json_encode('A user with this email already exists!');
            return;
        }
        if ($response['username'] == $data['username']) {                
            echo json_encode('A user with this username already exists!');
            return;
        }
        if ($response['phone'] == $data['phone']) {                
            echo json_encode('A user with this phone number already exists!');
            return;
        }
        return;
    }

    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);


    // Initialize create parameters
    
    $column = "username, password, email, firstname, lastname, position, department, address, phone, facebook, linkedin, twitter, user_id";
    $value = ":username, :password, :email, :firstname, :lastname, :position, :department, :address, :phone, :facebook, :linkedin, :twitter, :user_id";
        
        // Create client
    $response = $user->create($column,$value,$data);

    echo $response ? json_encode('Successful') : json_encode('Not Successful');
} else {
    $response = $user->readSingleRecord("email=:email OR username=:username", ['email' => $data['email'], 'username' => $data['username']]);
    
    if ($response && count($response) > 0) {
        if ($response['email'] === $data['email']) {                
            echo json_encode('A user with this email already exists!');
            return;
        }
        if ($response['username'] === $data['username']) {                
            echo json_encode('A user with this username already exists!');
            return;
        }
        return;
    }

    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT, ['cost' => 12]);


    // Initialize create parameters
    
    $column = "username, password, email, firstname, lastname, position, department, address, phone, facebook, linkedin, twitter";
    $value = ":username, :password, :email, :firstname, :lastname, :position, :department, :address, :phone, :facebook, :linkedin, :twitter";
        
    // Create client
    $response = $user->create($column,$value,$data);
    
    // Get last id from the table
    $id = $user->getLastId();
    
    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
}
