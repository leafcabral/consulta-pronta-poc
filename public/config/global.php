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

require_once $_SERVER['DOCUMENT_ROOT'] . "/config/database.php";

function get_post($name) {
	return filter_input(INPUT_POST, $name);
}

function render_template($file, $data = []) {
	if (file_exists($file)) {
		extract($data);
		include $file;
	}
}

function get_rendered_template($file, $data = []) {
	ob_start();
	render_template($file, $data);
	return ob_get_clean();
}

function verify_user_logged_in() {
	if (!isset($_SESSION["id_usuario"])) {
		header("Location: /pages/auth/login.php");
		exit;
	}
}