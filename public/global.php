<?php

require_once $_SERVER["DOCUMENT_ROOT"]. "/../includes/constants.php";
require_once INCLUDES . "database.php";
require_once INCLUDES . "helper.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set("America/Sao_Paulo");
session_start();
