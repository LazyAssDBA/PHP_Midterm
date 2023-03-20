<?php
    // ** Can probably move this to index.php **
    // Get id from URL
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get author
    $author->read_single();

    // Create array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    // Make JSON
    echo json_encode($author_arr);
?>