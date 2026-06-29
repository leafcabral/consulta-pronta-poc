<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function get_src_url_from_root() {
	// drive (C:) -> root (localhost) -> this (config.php)
	$drive_to_root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
	$drive_to_this = str_replace('\\', '/', __DIR__);
	$root_to_this = str_replace($drive_to_root, "", $drive_to_this);
	// remove /includes
	return dirname($root_to_this);
}

define("SRC_URL", get_src_url_from_root());
define("PAGE_URL", SRC_URL . "/pages");
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("DATE_FORMAT", "Y-m-d");

date_default_timezone_set("America/Sao_Paulo");
session_start();

require_once ROOT."/config/database.php";
require_once ROOT."/config/helper.php";