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

    // Depending upon the request method, include the appropriate php file
    switch ($method) {
        case 'GET' : isset($_GET['id']) ? include_once './read_single.php' : include_once './read.php'; break;
        case 'POST' : include_once './create.php'; break;
        case 'PUT' : include_once './update.php'; break;
        case 'DELETE' : include_once './delete.php'; break;
    }
    
?>