<?php
function filter_num_int($num) {
    $num = filter_var($num, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if (!is_numeric($num)) {
        return $return = array('resultado' => false, 'error' => "Invalid page number!", 'datos' => 1);
    }
    return $return = array('resultado' => true, 'error' => "", 'datos' => $num);
}

