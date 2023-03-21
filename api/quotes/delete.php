<?php
    // Set ID to update
    $quote->id = $data->id;

    // Delete quote
    if($quote->delete()) {
        echo json_encode(
            array('id' => $quote->id)
        );
    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }
?>