<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once '../config/Database.php';
require_once '../config/Model.php';

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'settings';

// Instantiate model object
$setting = new Model($db, $tb);
   
// Get info from URL
$default_user_id = isset($_GET['default_user_id']) ? $_GET['default_user_id'] : '';

// Get setting 
if (!empty($default_user_id)) {
    $response = $setting->readRecords("default_user_id=:default_user_id", ['default_user_id'=>$default_user_id], "id, site_name, address, logo, phone, email, default_user_id, smtp_address, smtp_username, smtp_password");

    echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

}
