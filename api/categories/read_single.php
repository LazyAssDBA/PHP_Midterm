<?php
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate dB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate category object
    $category = new Category($db);

    // Get id from URL
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get category
    $category->read_single();

    // Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    // Make JSON
    print_r(json_encode($category_arr));
?>