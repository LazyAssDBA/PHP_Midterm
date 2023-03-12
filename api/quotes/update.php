<?php
    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    // Instantiate dB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $quote->id = $data->id;

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;

    // Update quote
    if($quote->update()) {
        echo json_encode(
            array('message' => 'Quote Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Quote Not Updated')
        );
    }
?>