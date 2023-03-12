<?php
    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    // Instantiate dB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author = new Author($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->author = $data->author;

    // Create author
    if($author->create()) {
        echo json_encode(
            array('message' => 'Author Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Author Not Created')
        );
    }
?>