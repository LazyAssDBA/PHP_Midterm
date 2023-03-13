<?php
    // Set ID to update
    $quote->id = $data->id;

    // Delete quote
    if($quote->delete()) {
        echo json_encode(
            array('message' => 'Quote Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Quote Not Deleted')
        );
    }
?>