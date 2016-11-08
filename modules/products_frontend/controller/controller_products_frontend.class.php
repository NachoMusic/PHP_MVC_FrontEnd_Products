<?php
require_once("../../../paths.php");
include(SITE_ROOT . "modules/products_frontend/utils/utils.inc.php");
include(SITE_ROOT . 'classes/Log.class.singleton.php');
include(SITE_ROOT . 'utils/common.inc.php');
include(SITE_ROOT . 'utils/filters.inc.php');
include(SITE_ROOT . 'utils/response_code.inc.php');

$_SESSION['module'] = "products";

if ((isset($_GET["autocomplete"])) && ($_GET["autocomplete"] === "true")) {
    set_error_handler('ErrorHandler');
    $model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
    try {
        $nameProducts = loadModel($model_path, "products_model", "select_column_products", "product_name");
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($nameProducts) {
        $jsondata["nom_productos"] = $nameProducts;
        echo json_encode($jsondata);
        exit;
    } else {
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
}

if (($_GET["nom_product"])) {
    //filtrar $_GET["nom_product"]

    $result = filter_string($_GET["nom_product"]);
    if ($result['resultado']) {
        $criteria = $result['datos'];
    } else {
        $criteria = '';
    }
    $model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
    set_error_handler('ErrorHandler');
    try {

        $arrArgument = array(
            "column" => "product_name",
            "like" => $criteria
        );
        $producto = loadModel($model_path, "products_model", "select_like_products", $arrArgument);


        //throw new Exception(); //que entre en el catch
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($producto) {
        $jsondata["product_autocomplete"] = $producto;
        echo json_encode($jsondata);
        exit;
    } else {
        //if($producto){{ //que lance error si no existe el producto
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
}

if (($_GET["count_product"])) {
    //filtrar $_GET["count_product"]
    $result = filter_string($_GET["count_product"]);
    if ($result['resultado']) {
        $criteria = $result['datos'];
    } else {
        $criteria = '';
    }
    $model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
    set_error_handler('ErrorHandler');
    try {

        $arrArgument = array(
            "column" => "product_name",
            "like" => $criteria
        );
        $total_rows = loadModel($model_path, "products_model", "count_like_products", $arrArgument);
        //throw new Exception(); //que entre en el catch
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($total_rows) {
        $jsondata["num_products"] = $total_rows[0]["total"];
        echo json_encode($jsondata);
        exit;
    } else {
        //if($total_rows){ //que lance error si no existe el producto
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
}

//obtain num total pages
if ((isset($_GET["num_pages"])) && ($_GET["num_pages"] === "true")) {
    $item_per_page = 3;
    $path_model = SITE_ROOT . 'modules/products_frontend/model/model/';

    //change work error apache
    set_error_handler('ErrorHandler');

    try {
        //throw new Exception();
        $arrValue = loadModel($path_model, "products_model", "total_products");
        $get_total_rows = $arrValue[0]["total"]; //total records
        $pages = ceil($get_total_rows / $item_per_page); //break total records into pages
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }

    //change to defualt work error apache
    restore_error_handler();

    if ($get_total_rows) {
        $jsondata["pages"] = $pages;
        echo json_encode($jsondata);
        exit;
    } else {
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }

}


if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "true")) {
    showErrorPage(0, "ERROR - 503 BD Unavailable");
}
if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "false")) {
    showErrorPage(0, "ERROR - 404 NO DATA");
}




if (isset($_GET["idProduct"])) {
    $arrValue = null;
    //filter if idProduct is a number
    $result = filter_num_int($_GET["idProduct"]);
    if ($result['resultado']) {
        $id = $result['datos'];
    } else {
        $id = 1;
    }

    set_error_handler('ErrorHandler');
    try {
        //throw new Exception();
        $path_model = SITE_ROOT . 'modules/products_frontend/model/model/';
        $arrValue = loadModel($path_model, "products_model", "details_products", $id);
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($arrValue) {
        $jsondata["product"] = $arrValue[0];
        echo json_encode($jsondata);
        exit;
    } else {
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
} else {

    if (isset($_POST["page_num"])) {
        $result = filter_num_int($_POST["page_num"]);
        if ($result['resultado']) {
            $page_number = $result['datos'];
        }
    } else {
        $page_number = 1;
    }

    $item_per_page = 3;

    if (isset($_GET["keyword"])) {
        $result = filter_string($_GET["keyword"]);
        if ($result['resultado']) {
            $criteria = $result['datos'];
        } else {
            $criteria = '';
        }
    } else {
        $criteria = '';
    }

    if (isset($_POST["keyword"])) {
        $result = filter_string($_POST["keyword"]);
        if ($result['resultado']) {
            $criteria = $result['datos'];
        } else {
            $criteria = '';
        }
    }

    $position = (($page_number - 1) * $item_per_page);
    $model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
    $limit = $item_per_page;
    $arrArgument = array(
        "column" => "product_name",
        "like" => $criteria,
        "position" => $position,
        "limit" => $limit
    );
    set_error_handler('ErrorHandler');
    try {
        $resultado = loadModel($model_path, "products_model", "select_like_limit_products", $arrArgument);
    } catch (Exception $e) {
        /* paint_template_error("ERROR BD");
        die(); */
        showErrorPage(0, "ERROR - 503 BD Unavailable", 503);
    }
    restore_error_handler();

    if ($resultado) {

        paint_template_products($resultado);
    } else {
        //paint_template_error("NO PRODUCTS");
        showErrorPage(0, "ERROR - 404 NO PRODUCTS", 404);
    }


    //////// OLD: /////////
    // $item_per_page = 3;
    // //filter to $_POST["page_num"]
    // if (isset($_POST["page_num"])) {
    //     $result = filter_num_int($_POST["page_num"]);
    //     if ($result['resultado']) {
    //         $page_number = $result['datos'];
    //     }
    // } else {
    //     $page_number = 1;
    // }
    // set_error_handler('ErrorHandler');
    // try {
    //     //throw new Exception();
    //     $position = (($page_number - 1) * $item_per_page);
    //
    //     $arrArgument = array(
    //         'position' => $position,
    //         'item_per_page' => $item_per_page
    //     );
    //
    //     $path_model = SITE_ROOT . 'modules/products_frontend/model/model/';
    //     $arrValue = loadModel($path_model, "products_model", "page_products", $arrArgument);
    // } catch (Exception $e) {
    //     showErrorPage(0, "ERROR - 503 BD Unavailable");
    // }
    // restore_error_handler();
    //
    // if ($arrValue) {
    //     paint_template_products($arrValue);
    // } else {
    //     showErrorPage(0, "ERROR - 404 NO PRODUCTS");
    // }
}
