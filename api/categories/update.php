<?php
    // Set ID to update
    //$category->id = $data->id;

    // Make sure all paremeters are passed in
    if(!property_exists($data, 'id') || !property_exists($data, 'category'))  {
        echo json_encode(array('message' => 'Missing Required Parameters'));
    } else {
        // Set the category to update
        $category->category = $data->category;

        // Update category
        $category->update();

        // Create JSON array for output to user
        $category_arr = array('id' => $category->id, 'category' => $category->category);

        echo json_encode($category_arr);
    }
?>