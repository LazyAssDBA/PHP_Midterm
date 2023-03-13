<?php
    // Set ID to update
    $author->id = $data->id;

    // Delete author
    if($author->delete()) {
        echo json_encode(
            array('message' => 'Author Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Author Not Deleted')
        );
    }
?>