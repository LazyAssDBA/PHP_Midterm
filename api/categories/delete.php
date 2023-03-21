<?php
    // Set ID to update
    //$category->id = $data->id;

    // Delete category
    $category->delete();
    //if($category->delete()) {
    //    echo json_encode(
    //        array('message' => 'Category Deleted')
    //    );
    //} else {
    //    echo json_encode(
    //        array('message' => 'Category Not Deleted')
    //    );
    //}

    // Create a JSON array to inform which user was deleted
    $category_arr = array('id' => $category->id);

    echo json_encode($category_arr);
?>