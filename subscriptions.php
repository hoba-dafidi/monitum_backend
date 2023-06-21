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
$tb = 'subscriptions';

// Instantiate model object
$subscription = new Model($db, $tb);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

        // Get subscription 
        if (!empty($user_id)) {
            $response = $subscription->readRecords("user_id=:user_id ORDER BY created_on ASC", ["user_id"=>$user_id], "id, plan, details, price, duration, duration_type");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }

    break;

    case 'POST':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $subscription->sanitize($data);

        // Initialize create parameters
        $column = "plan, details, price, duration, duration_type, user_id";
        $value = ":plan, :details, :price, :duration, :duration_type, :user_id";
        
            // Create subscription
        $response = $subscription->create($column,$value,$data);

        $id = $subscription->getLastId();

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $subscription->readSingleRecord("id=:id", ["id"=>$id], "plan, details, price, duration, duration_type, id, user_id")]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $subscription->sanitize($data);
        extract($data);

        // Initialize parameters
        $column = "plan=:plan";

        $update_data = [
            'id' => $id,
            'plan' => $plan,
        ];

        // Update subscription
        $response = $subscription->update($column,"id=:id",$update_data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
  
    break;

    case 'DELETE':
        $id = $_GET['id'];
        
        $response = $subscription->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    default:
    break;
}