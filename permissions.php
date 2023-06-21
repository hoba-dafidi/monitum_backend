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
$tb = 'permissions';

// Instantiate model object
$permission = new Model($db, $tb);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $user = isset($_GET['user']) ? $_GET['user'] : '';

        // Get permission 
        if ($user == 2) {
            $response = $permission->readRecords("1 ORDER BY created_on ASC");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }

    break;

    case 'POST':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $permission->sanitize($data);

        // Initialize create parameters
        $column = "user_type_id, create_client, view_client, edit_client, delete_client, create_user, view_user, edit_user, delete_user, create_subscription, view_subscription, edit_subscription, delete_subscription, manage_settings";

        $value = ":user_type_id, :create_client, :view_client, :edit_client, :delete_client, :create_user, :view_user, :edit_user, :delete_user, :create_subscription, :view_subscription, :edit_subscription, :delete_subscription, :manage_settings";
            
        // Create permission
        $response = $permission->create($column,$value,$data);
        
        // $id = $permission->getLastId();
        
        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $permission->sanitize($data);
        extract($data);

        // Initialize parameters
        $column = "create_client=:create_client";

        $update_data = [
            'id' => $id,
            'create_client' => $create_client,
        ];

            // Update permission
        $response = $permission->update($column,"id=:id",$update_data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
  
    break;

    case 'DELETE':
        $id = $_GET['id'];
        
        $response = $permission->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    default:
    break;
}