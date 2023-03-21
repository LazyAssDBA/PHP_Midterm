<?php
    // Set ID to update
    //$author->id = $data->id;

    // Make sure all paremeters are passed in
    if(!property_exists($data, 'id') || !property_exists($data, 'author'))  {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } else {
        // Set the author to update
        $author->author = $data->author;

        // Update author
        $author->update();

        // Create JSON array for output to user
        $author_arr = array('id' => $author->id, 'author' => $author->author);

        echo json_encode($author_arr);
    }
?>