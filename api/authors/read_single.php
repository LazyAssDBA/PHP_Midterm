<?php
    // Get id from URL
    $author->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get author
    $author->read_single();

    // Create array
    $author_arr = array(
        'id' => $author->id,
        'author' => $author->author
    );

    // ** Can probably move this to index.php **
    // Make JSON
    print_r(json_encode($author_arr));
?>