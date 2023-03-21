<?php
    // Use this function to validate id's in any model by calling read_single() to see if the id exists in the database
    function isValid($id, $model) {
        $model->id = $id;
        $result = $model->read_single();
        return $result;
    }
?>