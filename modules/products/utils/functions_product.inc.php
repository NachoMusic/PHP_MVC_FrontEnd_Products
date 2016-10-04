<?php

function validate_product($value) {
    //return json_encode("Hola mundo");
    $error = array();
    $valido = true;
    $filter = array(
        'product_name' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^[A-Za-z]{2,30}$/')
        ),
        'product_description' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^[A-Za-z]{2,200}$/')
        ),
        'product_price' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^[a-z0-9- -.]/')
        ),
        'product_id' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^[a-z0-9- -.]/')
        ),
        'enter_date' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/')
        ),
        'obsolescence_date' => array(
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => array('regexp' => '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/')
        ),
    );


    $result = filter_input_array($value, $filter);

    //no filter
    $result['product_categoty'] = $_POST['product_categoty'];
    $result['availability'] = $_POST['availability'];

    //obsolescence date can't be before enter date
    /*$dates = validate_dates($_POST['enter_date'], $_POST['obsolescence_date']);
    if (!$dates) {
        $error['obsolescence_date'] = "Obsolescence date can't be before enter date";
        $valido = false;
    }*/
    //
    // if (!$result['product_name']) {
    //     $error['name'] = 'Name must be 2 to 30 letters';
    //     $valido = false;
    // }
    // if (count($result['availability']) == 0) {
    //     console_log("dentro");
    //     $error['availability'] = "Select 1 or more.";
    //     $valido = false;
    // }

    // if (!$result['enter_date']) {
    //     if ($_POST['enter_date'] == "") {
    //         $error['enter_date'] = "this camp can't empty";
    //         $valido = false;
    //     } else {
    //         $error['enter_date'] = 'error format date (dd/mm/yyyy)';
    //         $valido = false;
    //     }
    // }

    // if (!$result['obsolescence_date']) {
    //     if ($_POST['obsolescence_date'] == "") {
    //         $error['obsolescence_date'] = "this camp can't empty";
    //         $valido = false;
    //     } else {
    //         $error['obsolescence_date'] = 'error format date (dd/mm/yyyy)';
    //         $valido = false;
    //     }
    // }

    /*if ($_POST['product_categoty'] === 'Select product') {
        $error['product_categoty'] = "You haven't select a product.";
        $valido = false;
    }*/

    return $return = array('resultado' => $valido, 'error' => $error, 'datos' => $result);
}

function validate_dates($enter_date, $obsolescence_date) {
    $day1 = substr($enter_date, 0, 2);
    $month1 = substr($enter_date, 3, 2);
    $year1 = substr($enter_date, 6, 4);
    $day2 = substr($obsolescence_date, 0, 2);
    $month2 = substr($obsolescence_date, 3, 2);
    $year2 = substr($obsolescence_date, 6, 4);

    if (strtotime($day1 . "-" . $month1 . "-" . $year1) <= strtotime($year2 . "-" . $month2 . "-" . $day2)) {
        return true;
    }
    return false;
}
