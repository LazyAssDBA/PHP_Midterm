<?php
    // Set ID to update
    $category->id = $data->id;

    // Delete category
    if($category->delete()) {
        echo json_encode(
            array('message' => 'Category Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Deleted')
        );
    }
?>