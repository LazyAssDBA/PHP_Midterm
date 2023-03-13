<?php
    //explore using: $authorId = $_GET[authorId] ?? 'some value';
    //explore using: $authorId = filter_input(INPUT_GET, 'authorId', FILTER_SANITIZE_NUMBER_INT);

    // Quote read query
    $result = $quote->read();
    // Get row count
    $num = $result->rowCount();

    // Check if any quotes
    if($num > 0) {
        // Quote array
        $quote_arr = array();
        $quote_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $quote_item = array(
                'id' => $id,
                'quote' => $quote,
                //'author_id' => $author_id,
                'author' => $author,
                //'category_id' => $category_id,
                'category' => $category
            );

            // Push to "data"
            array_push($quote_arr['data'], $quote_item);
        }

        // Turn to JSON & output
        echo json_encode($quote_arr);

    } else {
        // No Quotes
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }
?>