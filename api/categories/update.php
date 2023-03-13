<?php
    // Set ID to update
    $category->id = $data->id;

    $category->category = $data->category;

    // Update category
    if($category->update()) {
        echo json_encode(
            array('message' => 'Category Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Category Not Updated')
        );
    }
?>