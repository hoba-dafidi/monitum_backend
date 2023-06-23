<?php 
header('Access-Control-Allow-Origin: https://monitum.no');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Headers: X-Requested-With');
header('Access-Control-Allow-Credentials: true');

require_once '../config/Database.php';
require_once '../config/Model.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail     = new PHPMailer();

// Instantiate Database and connect
$database = new Database();
$db = $database->connect();
$tb = 'sent_forms';

// Instantiate model object
$sent_form = new Model($db, $tb);

// Get raw posted data
$post_data = json_decode(file_get_contents("php://input"), true);
extract($post_data);

// Declare variables
$column = "user_id, status, forms, recipient, subject, message";
$value = ":user_id, :status, :forms, :recipient, :subject, :message";

$data = [
    'user_id' => $user_id,
    'status' => $status,
    'forms' => json_encode($forms),
    'recipient' => $recipient,
    'subject' => $subject,
    'message' => $message,
];
$mail_data = [
    'forms' => $forms,
    'recipient' => $recipient,
    'subject' => $subject,
    'message' => $message,
];

// Create sent_form
$response = $sent_form->create($column,$value,$data);
if ($response) {
    $mailsent = '';
    $maildata = $sent_form->mail_user($mail, $mail_data);
    if($maildata['mailsent']){
        echo  json_encode(["success" => true, "message" => "Email sent Successful", "data" => null]) ;
    }else{
        echo json_encode(["success" => false, "message" => "Email sending Not Successful", "data" => null]);
    }			
} else {
    echo json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

}

        