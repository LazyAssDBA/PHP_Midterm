<?php
    // Set ID to update
    //$author->id = $data->id;

    // Delete author
    $author->delete();
    //if($author->delete()) {
    //    echo json_encode(
    //        array('message' => 'Author Deleted')
    //    );
    //} else {
    //    echo json_encode(
    //        array('message' => 'Author Not Deleted')
    //    );
    //}

    // Create a JSON array to inform which user was deleted
    $author_arr = array('id' => $author->id);

    echo json_encode($author_arr);
?>