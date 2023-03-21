<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Get the value of the HTTP request method
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

    // I pulled this code out of the categories sibling .php files and consolidated it here
    //---------------------------------------------------------------------------------
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate dB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    //---------------------------------------------------------------------------------

    // Use the isValid() function to determine if id passed in query string is valid
    include_once '../../functions/isValid.php';
    if(isset($_GET['id'])) {
        $id =$_GET['id'];
        $idExists = isValid($id, $category);
    } elseif (isset($data->id)) {
        $id = $data->id;
        $idExists = isValid($id, $category);
    }

    // Depending upon the request method, include the appropriate php file
    switch ($method) {
        case 'POST' : include_once './create.php'; break;
        case 'GET' : 
            if(isset($id)) {
                if($idExists) {
                    include_once 'read_single.php';
                } else {
                    echo json_encode(array('message' => 'category_id Not Found'));
                }
            } else {
                include_once 'read.php';
            } break;
        case 'PUT' : 
            if($idExists) {
                include_once './update.php';
            } else {
                echo json_encode(array('message' => 'category_id Not Found'));
            } break;
        case 'DELETE' : 
            if($idExists) {
                include_once './delete.php';
            } else {
                echo json_encode(array('message' => 'category_id Not Found'));
            } break;
    }
    
?>