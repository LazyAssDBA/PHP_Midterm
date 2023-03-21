<?php
    // Get id from URL
    //$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get quote
    $quote->read_single();

    // Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        //'author_id' => $quote->author_id,
        'author' => $quote->author,
        //'category_id' => $quote->category_id,
        'category' => $quote->category
    );

    // Make JSON
    echo json_encode($quote_arr);
?>