<?php
    // Make sure all paremeters are passed in
        if(!property_exists($data, 'quote') 
        || !property_exists($data, 'author_id')
        || !property_exists($data, 'category_id')) {
            echo json_encode(array('message' => 'Missing Required Parameters'));
    } else {
        // Include author and category Models
        include_once '../../models/Author.php';
        include_once '../../models/Category.php';

        // Instantiate author and category objects
        $author = new Author($db);
        $category = new Category($db);

        // Check if author and category are valid
        if(!isValid($data->author_id, $author)) {
            echo json_encode(array('message' => 'author_id Not Found'));
        } elseif(!isValid($data->category_id, $category)){        
            echo json_encode(array('message' => 'category_id Not Found'));
        } else {
            // Set quote to update
            //$quote->id = $data->id;
            $quote->quote = $data->quote;
            $quote->author_id = $data->author_id;
            $quote->category_id = $data->category_id;

            // Update quote
            if($quote->update()) {
                // Create JSON array for output to user
                $quote_arr = array (
                    'id' => $quote->id,
                    'quote' => $quote->quote, 
                    'author_id' => $quote->author_id,
                    'category_id' => $quote->category_id
                );
                echo json_encode($quote_arr);
            } else {
                echo json_encode(
                    array('message' => 'No Quotes Found')
                );
            }
        }
    }
?>