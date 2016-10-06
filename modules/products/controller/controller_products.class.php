<?php
session_start();
include ($_SERVER['DOCUMENT_ROOT'] . "/nacho_framework2DAW/modules/products/utils/functions_product.inc.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/nacho_framework2DAW/utils/upload.php");

if ((isset($_GET["upload"])) && ($_GET["upload"] == true)) {
   // echo upload_files();
    $result_avatar = upload_files();
    $_SESSION["result_avatar"] = $result_avatar;
    echo json_encode($result_avatar);
    exit;
    //$_SESSION['result_avatar'] = $result_avatar;
    //echo debug($_SESSION['result_avatar']); //se mostraría en alert(response); de dropzone.js
}

if ((isset($_POST['alta_products_json']))) {
    //echo json_encode("Hola mundo");
    alta_products();
    //echo validate_prouct();
}

function alta_products() {
    $jsondata = array();
    $productsJSON = json_decode($_POST["alta_products_json"], true);

    $result = validate_product($productsJSON);


    if ($_SESSION['result_avatar']['datos'] == "") {
        $_SESSION['result_avatar'] = array('resultado' => true, 'error' => "", 'datos' => 'media/default-avatar.png');
    }
    $result_avatar = $_SESSION['result_avatar'];


    if ($result['resultado']) {

        $arrArgument = array(
            'product_name' => ucfirst($result['datos']['product_name']),
            'product_description' => ucfirst($result['datos']['product_description']),
            'product_price' => $result['datos']['product_price'],
            'product_id' => $result['datos']['product_id'],
            'enter_date' => $result['datos']['enter_date'],
            'obsolescence_date' => $result['datos']['obsolescence_date'],
            'product_category' => $result['datos']['product_category'],
            'availability' => $result['datos']['availability'],
        );

        $mensaje = "User has been successfully registered";
        //redirigir a otra pagina con los datos de $arrArgument y $mensaje
        $_SESSION['product'] = $arrArgument;
        $_SESSION['msje'] = $mensaje;

        $callback = "index.php?module=products&view=results_products";
        //$jsondata['product'] = $arrArgument;
        $jsondata["success"] = true;
        $jsondata["redirect"] = $callback;
        echo json_encode($jsondata);
    } else {
        //console_log("false");
        $jsondata["success"] = false;
        $jsondata["error"] = $result['error'];
        //future avatar error

        header('HTTP/1.0 400 Bad error');
        echo json_encode($jsondata);
    }
}

if (isset($_GET["delete"]) && $_GET["delete"] == true) {
    $result = remove_files();
    //echo json_encode($result);
    //exit;

    $_SESSION['result_avatar'] = array();
    $result = remove_files();
    if ($result === true) {
        echo json_encode(array("res" => true));
    } else {
        echo json_encode(array("res" => false));
    }
    //echo remove_files();
   // echo remove_files();
}

///////////////////////////// Load data //////////////////////////////////
if (isset($_GET["load"]) && $_GET["load"] == true) {
    $jsondata = array();
    if (isset($_SESSION['product'])) {
        //echo debug($_SESSION['user']);
        $jsondata["product"] = $_SESSION['product'];
    }
    if (isset($_SESSION['msje'])) {
        //echo $_SESSION['msje'];
        $jsondata["msje"] = $_SESSION['msje'];
    }
    $jsondata["avatar"] = $_SESSION["result_avatar"];
    close_session();
    echo json_encode($jsondata);
    exit;
}

function close_session() {
    unset($_SESSION['user']);
    unset($_SESSION['msje']);
    $_SESSION = array(); // Destruye todas las variables de la sesión
    session_destroy(); // Destruye la sesión
}
