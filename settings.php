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
$tb = 'settings';

// Instantiate model object
$setting = new Model($db, $tb);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $default_user_id = isset($_GET['default_user_id']) ? $_GET['default_user_id'] : '';

        // Get setting 
        if (!empty($default_user_id)) {
            $response = $setting->readRecords("default_user_id=:default_user_id", ['default_user_id'=>$default_user_id], "id, site_name, address, logo, phone, email, default_user_id, smtp_address, smtp_username, smtp_password");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }

    break;

    case 'POST':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $setting->sanitize($data);

        // Initialize create parameters
        $column = "site_name, address, logo, phone, email, default_user_id, smtp_address, smtp_username, smtp_password";
        $value = ":site_name, :address, :logo, :phone, :email, :default_user_id, :smtp_address, :smtp_username, :smtp_password";
        
        // Create setting
        $response = $setting->create($column,$value,$data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $setting->sanitize($data);
        extract($data);

        // Initialize parameters
        $column = "smtp_address=:smtp_address";

        $update_data = [
            'id' => $id,
            'smtp_address' => $smtp_address,
        ];

            // Update setting
        $response = $setting->update($column,"id=:id",$update_data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

    break;

    case 'DELETE':
        $id = $_GET['id'];
        
        $response = $setting->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    default:
    break;
}