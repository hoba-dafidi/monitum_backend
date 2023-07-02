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
$tb = 'users';
// $tb = 'clients';
$tb2 = 'address';

// Instantiate model object
$client = new Model($db, $tb);
$address_model = new Model($db, $tb2);

// Get raw posted data as associative array
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['user_id'])) {
    $response = $client->readSingleRecord("email=:email OR username=:username OR phone=:phone", ['email' => $data['email'], 'username' => $data['username'], 'phone' => $data['phone']]);

    if ($response && count($response) > 0) {
        if ($response['email'] == $data['email']) {
            echo json_encode(["success" => false, "message" => 'A user with this email already exists!', "data" => null]);
            return;
        }
        if ($response['username'] == $data['username']) {
            echo json_encode(["success" => false, "message" => 'A user with this username already exists!', "data" => null]);
            return;
        }
        if ($response['phone'] == $data['phone']) {
            echo json_encode(["success" => false, "message" => 'A user with this phone number already exists!', "data" => null]);
            return;
        }
        return;
    }

    extract($data);
    // Hash password
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Initialize create parameters
    $column = "username, password, email, firstname, lastname, organisation, department, phone, user_id, is_client";
    $value = ":username, :password, :email, :firstname, :lastname, :organisation, :department, :phone, :user_id, :is_client";
    $data = [
        "username" => $username,
        "password" => $password,
        "email" => $email,
        "firstname" => $firstname,
        "lastname" => $lastname,
        "organisation" => $organisation,
        "department" => $department,
        "phone" => $phone,
        "user_id" => $user_id,
        "is_client" => $is_client
    ];

    // Create Client
    $response1 = $client->create($column, $value, $data);
    $last_id = $client->getLastId();

    $address_column = "street, city, state, postal_code, country, user_id";
    $address_value = ":street, :city, :state, :postal_code, :country, :user_id";
    $address_data = [
        "street" => $address['street'],
        "city" => $address['city'],
        "state" => $address['state'],
        "postal_code" => $address['postal_code'],
        "country" => $address['country'],
        "user_id" => $last_id,
    ];

    // Create Address
    $response2 = $address_model->create($address_column, $address_value, $address_data);

    echo $response1 && $response2 ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
} else {
    $response = $client->readSingleRecord("email=:email OR username=:username OR phone=:phone", ['email' => $data['email'], 'username' => $data['username'], 'phone' => $data['phone']]);

    if ($response && count($response) > 0) {
        if ($response['email'] == $data['email']) {
            echo json_encode(["success" => false, "message" => 'A user with this email already exists!', "data" => null]);
            return;
        }
        if ($response['username'] == $data['username']) {
            echo json_encode(["success" => false, "message" => 'A user with this username already exists!', "data" => null]);
            return;
        }
        if ($response['phone'] == $data['phone']) {
            echo json_encode(["success" => false, "message" => 'A user with this phone number already exists!', "data" => null]);
            return;
        }
        return;
    }

    // print_r($data);
    extract($data);
    // Hash password
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Initialize create parameters
    $column = "username, password, email, firstname, lastname, organisation, department, phone, is_client";
    $value = ":username, :password, :email, :firstname, :lastname, :organisation, :department, :phone, :is_client";
    $data = [
        "username" => $username,
        "password" => $password,
        "email" => $email,
        "firstname" => $firstname,
        "lastname" => $lastname,
        "organisation" => $organisation,
        "department" => $department,
        "phone" => $phone,
        "is_client" => $is_client
    ];

    // Create Client
    $response1 = $client->create($column, $value, $data);
    $last_id = $client->getLastId();

    $address_column = "street, city, state, postal_code, country, user_id";
    $address_value = ":street, :city, :state, :postal_code, :country, :user_id";
    $address_data = [
        "street" => $address['street'],
        "city" => $address['city'],
        "state" => $address['state'],
        "postal_code" => $address['postal_code'],
        "country" => $address['country'],
        "user_id" => $last_id,
    ];

    // Create Address
    $response2 = $address_model->create($address_column, $address_value, $address_data);

    echo $response1 && $response2 ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
}
