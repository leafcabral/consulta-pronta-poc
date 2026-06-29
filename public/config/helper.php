<?php

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

function data_para_string_legal($data) {
	$meses = [
		1 => 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
		'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'
	];
	$timestamp = strtotime($data);

	$dia = date('d', $timestamp);
	$mes_numero = (int) date('m', $timestamp);
	$ano = date('Y', $timestamp);
	
	return "{$dia} de {$meses[$mes_numero]} de {$ano}";
}