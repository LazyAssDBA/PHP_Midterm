<?php
    // Make sure all paremeters are passed in
    if(!property_exists($data, 'author')) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } else {
        // Set the author to create
        $author->author = $data->author;

        // Create author
        if($author->create()) {
            // Create JSON array for output to user
            $author_arr = array (
                'id' => $db->lastInsertId(),
                'author' => $author->author
            );
            echo json_encode($author_arr);
        } else {
            echo json_encode(
                array('message' => 'Author Not Created')
            );
        }
    }
?>