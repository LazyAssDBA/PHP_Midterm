<?php
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate dB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $category->id = $data->id;

    // Delete category
    if($category->delete()) {
        echo json_encode(
            array('message' => 'Category Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Deleted')
        );
    }
?>