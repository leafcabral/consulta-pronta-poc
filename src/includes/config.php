<?php

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

session_start();