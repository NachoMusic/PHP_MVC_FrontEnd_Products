<?php
function loadModel($model_path, $model_name, $function, $arrArgument = '') {
    $model = $model_path . $model_name . '.class.singleton.php';

    if (file_exists($model)) {
        include_once($model);

        $modelClass = $model_name;

        if (!method_exists($modelClass, $function)){
            // die($function . ' function not found in Model ' . $model_name);
            throw new Exception();
        }

        $obj = $modelClass::getInstance();

        if (isset($arrArgument)) {
            return $obj->$function($arrArgument);
        }
    } else {
        // die($model_name . ' Model Not Found under Model Folder');
        throw new Exception();
    }
}
function loadView($rutaVista = '', $templateName= '', $arrPassValue = '') {
    $view_path = $rutaVista . $templateName;
    $arrData = '';

    if (file_exists($view_path)) {
        if (isset($arrPassValue))
        $arrData = $arrPassValue;
        include_once($view_path);
    } else {
        $log = Log::getInstance();
        $log->add_log_general("error loadView general", $_GET['module'], "response ".http_response_code()); //$text, $controller, $function
        $log->add_log_user("error loadView general", "", $_GET['module'], "response ".http_response_code());//$msg, $username = "", $controller, $function


        $result = response_code(http_response_code());
        $arrData = $result;
        require_once $_SERVER['DOCUMENT_ROOT'].'/nacho_framework2DAW/view/inc/templates_error/'. "error" .'.php';
        //die();

    }
}
// function loadView($rutaVista, $templateName, $arrPassValue = '') {
//     $view_path = $rutaVista . $templateName;
//     $arrData = '';
//
//     if (file_exists($view_path)) {
//         if (isset($arrPassValue))
//         $arrData = $arrPassValue;
//         include_once($view_path);
//     } else {
//         //die($templateName . ' Template Not Found under View Folder');
//
//         $message = "NO TEMPLATE FOUND";
//         $arrData = $message;
//         require_once $_SERVER['DOCUMENT_ROOT'] . '/nacho_framework2DAW/view/inc/404.php';
//         die();
//     }
// }
