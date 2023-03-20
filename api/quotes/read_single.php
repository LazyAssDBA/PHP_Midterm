<?php
    // Get id from URL
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get quote
    $quote->read_single();

    // Create array
    if ($quote->quote) {
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        //'author_id' => $quote->author_id,
        'author' => $quote->author,
        //'category_id' => $quote->category_id,
        'category' => $quote->category
    );} else {
        // No Quote
        echo json_encode(
            array('message:' => 'quote_id Not Found')
        );
    }

    // Make JSON
    echo json_encode($quote_arr);
?>