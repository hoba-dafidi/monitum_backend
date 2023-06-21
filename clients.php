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
$tb = 'clients';
$tb2 = 'address';

// Instantiate model object
$client = new Model($db, $tb);
$address_model = new Model($db, $tb2);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':       
        // Get info from URL
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
        $user = isset($_GET['user']) ? $_GET['user'] : '';

        // Get client 
        if (!empty($user_id)) {
            $response = $client->joinRecords("id", "user_id", $tb2, "t1.user_id=:user_id", ["user_id"=>$user_id], "t1.id, t1.username, t1.password, t1.email, t1.firstname, t1.lastname, t1.organisation, t1.department, t1.phone, t1.logo, t1.user_id, t2.street, t2.city, t2.state, t2.postal_code, t2.country");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        } 
        else if (!empty($user) && $user == 2) {
            $response = $client->joinRecords("id", "user_id", $tb2, "t1.user_id is null", [], "t1.id, t1.username, t1.password, t1.email, t1.firstname, t1.lastname, t1.organisation, t1.department, t1.phone, t1.logo, t1.user_id, t2.street, t2.city, t2.state, t2.postal_code, t2.country");

            echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => $response]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);

        }

    break;

    case 'POST':
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
            $column = "username, password, email, firstname, lastname, organisation, department, phone, user_id";
            $value = ":username, :password, :email, :firstname, :lastname, :organisation, :department, :phone, :user_id";
            $data = [
                "username" => $username,
                "password" => $password,
                "email" => $email,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "organisation" => $organisation,
                "department" => $department,
                "phone" => $phone,
                "user_id" => $user_id
            ];
    
            // Create Client
            $response1 = $client->create($column,$value,$data);
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
            $response2 = $address_model->create($address_column,$address_value,$address_data);
    
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

        extract($data);
        // Hash password
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

        // Initialize create parameters
        $column = "username, password, email, firstname, lastname, organisation, department, phone";
        $value = ":username, :password, :email, :firstname, :lastname, :organisation, :department, :phone";
        $data = [
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "organisation" => $organisation,
            "department" => $department,
            "phone" => $phone
        ];

        // Create Client
        $response1 = $client->create($column,$value,$data);
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
        $response2 = $address_model->create($address_column,$address_value,$address_data);

        echo $response1 && $response2 ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
                    
        }
    break;

    case 'PUT':
    case 'PATCH':
        // Get raw posted data
        $data = json_decode(file_get_contents("php://input"), true);

        // Sanitize the data
        $data = $client->sanitize($data);
        
        // Initialize parameters        
        extract($data);
        $column = "phone=:phone";
        $update_data = [
            'id' => $id,
            'phone' => $phone,
        ];

            // Update client
        $response = $client->update($column,"id=:id",$update_data);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
  
    break;

    case 'DELETE':
        $id = $_GET['id'];
        
        $response = $client->delete("id=:id", ['id' => $id]);

        echo $response ? json_encode(["success" => true, "message" => "Successful", "data" => null]) : json_encode(["success" => false, "message" => "Not Successful", "data" => null]);
        
    break;

    default:
    break;
}
