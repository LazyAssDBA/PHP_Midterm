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
    //---------------------------------------------------------------------------------

    // Depending upon the request method, include the appropriate php file
    switch ($method) {
        case 'GET' : isset($_GET['id']) ? include_once './read_single.php' : include_once './read.php'; break;
        case 'POST' : include_once './create.php'; break;
        case 'PUT' : include_once './update.php'; break;
        case 'DELETE' : include_once './delete.php'; break;
    }
    
?>