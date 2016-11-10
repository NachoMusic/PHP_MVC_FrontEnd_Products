<?php
session_start();
$_SESSION['module'] = "";

//$_SESSION["result_avatar"] = array();
require_once("view/inc/header.php");
require_once('view/inc/menu.html');
include 'utils/utils.inc.php';
// require_once("paths.php");
if (PRODUCTION) { //we are in production
    ini_set('display_errors', '1');
    ini_set('error_reporting', E_ERROR | E_WARNING | E_NOTICE); //error_reporting(E_ALL) ;
} else {
    ini_set('display_errors', '0');
    ini_set('error_reporting', '0'); //error_reporting(0);
}

if (!isset($_GET['module'])) {
    include_once('modules/main/controller/controller_main.class.php');
} else if (isset($_GET['module']) && (!isset($_GET['view']))) {
    include_once("modules/" . $_GET['module'] . "/controller/controller_" . $_GET['module'] . ".class.php");
}

if (isset($_GET['module']) && isset($_GET['view'])) {
    include_once("modules/" . $_GET['module'] . "/view/" . $_GET['view'] . ".php");
}

// function handlerRouter() {
//     if (!empty($_GET['module'])) {
//         $URI_module = $_GET['module'];
//     } else {
//         $URI_module = 'main';
//     }
//
//     if (!empty($_GET['function'])) {
//         $URI_function = $_GET['function'];
//     } else {
//         $URI_function = 'begin';
//     }
//
//     handlerModule($URI_module, $URI_function);
// }
//
// function handlerModule($URI_module, $URI_function) {
//     $modules = simplexml_load_file('resources/modules.xml');
//     $exist = false;
//
//     foreach ($modules->module as $module) {
//         if (($URI_module === (String)$module->uri)) {
//             $exist = true;
//
//             $path = MODULES_PATH . $URI_module."/controller/controller_".$URI_module.".class.php";
//             if (file_exists($path)) {
//                 require_once($path);
//
//                 $controllerClass = "controller_" . $URI_module;
//                 $obj = new $controllerClass;
//
//             } else {
//                 //die($URI_module . ' - Controlador no encontrado');
//                 showErrorPage(1, "", 'HTTP/1.0 400 Bad Request', 400);
//             }
//             handlerfunction(((String)$module->name), $obj, $URI_function);
//             break;
//         }
//     }
//     if (!$exist) {
//         //die($URI_module . ' - Controlador no encontrado');
//         showErrorPage(1, "", 'HTTP/1.0 400 Bad Request', 400);
//     }
// }
//
// function handlerFunction($module, $obj, $URI_function) {
//     $functions = simplexml_load_file(MODULES_PATH . $module. "/resources/functions.xml");
//     $exist = false;
//
//     foreach ($functions->function as $function) {
//         if (($URI_function === (String)$function->uri)) {
//             $exist = true;
//             $event = (String) $function->name;
//             break;
//         }
//     }
//     if (!$exist) {
//         //die($URI_function . ' - Funci&oacute;n no encontrada');
//         showErrorPage(1, "", 'HTTP/1.0 400 Bad Request', 400);
//     } else {
//         //$obj->$event();
//         call_user_func(array($obj,$event));
//     }
// }

// handlerRouter();

require_once('view/inc/footer.html');
