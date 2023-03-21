<?php
    // Make sure all paremeters are passed in
    if(!property_exists($data, 'category')) {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } else {
        // Set the category to create
        $category->category = $data->category;

        // Create category
        if($category->create()) {
            // Create JSON array for output to user
            $category_arr = array (
                'id' => $db->lastInsertId(),
                'category' => $category->category
            );
            echo json_encode($category_arr);
        } else {
            echo json_encode(
                array('message' => 'Category Not Created')
            );
        }
    }
?>