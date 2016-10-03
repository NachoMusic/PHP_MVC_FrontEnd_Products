<?php

require_once("view/inc/header.html");
require_once('view/inc/menu.html');
include 'utils/utils.inc.php';
  session_start();

if (!isset($_GET['module'])) {
    include_once('modules/main/controller/controller_main.class.php');
} else if (isset($_GET['module']) && (!isset($_GET['view']))) {
    include_once("modules/" . $_GET['module'] . "/controller/controller_" . $_GET['module'] . ".class.php");
}

if (isset($_GET['module']) && isset($_GET['view'])) {
    include_once("modules/" . $_GET['module'] . "/view/" . $_GET['view'] . ".php");
}

require_once('view/inc/footer.html');
