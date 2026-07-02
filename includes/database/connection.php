<?php
require_once __DIR__ . "/../constants.php";

function connect_to_database() {
	$server = "localhost";
	$user = "root"; 
	$password = "usbw";
	$database_name = "consultapronta_poc";

	$connection = mysqli_connect($server, $user, $password, $database_name);
	mysqli_set_charset($connection, "utf8mb4");

	return $connection;
}

function format_assoc_to_pairs($connection, $data) {
	$pairs = [];
	foreach ($data as $key => $value) {
		if ($value == null) {
			$pairs[] = "$key = NULL";
		} elseif (is_numeric($value)) {
			$pairs[] = "$key = $value";
		} else {
			$safe_value = mysqli_real_escape_string($connection, $value);
			$pairs[] = "$key = '$safe_value'";
		}
	}

	return implode(", ", $pairs);
}

function format_assoc_to_lists($connection, $data) {
	$escaped_values = [];
	foreach ($data as $value) {
		if ($value == null) {
			$escaped_values[] = "NULL";
		} elseif (is_numeric($value)) {
			$escaped_values[] = $value;
		} else {
			$safe_value = mysqli_real_escape_string($connection, $value);
			$escaped_values[] = "'$safe_value'";
		}
	}

	return [
		'columns' => implode(", ", array_keys($data)),
		'values'  => implode(", ", $escaped_values)
	];
}

function check_result_return_first($result) {
	if ($result == false) { return $result; }
	return mysqli_fetch_assoc($result);
}

function check_result_return_all($result) {
	if ($result == false) { return $result; }
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function select_table_row($table, $row_name, $value) {
	$connection = connect_to_database();

	$sql_command = "SELECT * FROM $table WHERE $row_name = $value";
	$result = mysqli_query($connection, $sql_command);
	
	return check_result_return_first($result);
}

function select_table_rows($table, $row_name, $value) {
	$connection = connect_to_database();

	$sql_command = "SELECT * FROM $table WHERE $row_name = $value";
	$result = mysqli_query($connection, $sql_command);
	
	return check_result_return_all($result);
}

function insert_table_row($table, $data) {
	$connection = connect_to_database();
	
	$formatted = format_assoc_to_lists($connection, $data);
	$columns = $formatted["columns"];
	$values = $formatted["values"];

	$sql_command = "INSERT INTO $table ($columns) VALUES ($values)";
	$result = mysqli_query($connection, $sql_command);

	if ($result) {
		$insert_id = mysqli_insert_id($connection);
		// Se não for auto increment, $insert_id daria 0, então retorna 
		// true só pra falar que deu certo mas o id é Manuel
		return ($insert_id > 0) ? $insert_id : true;
	}
	
	return false;
}

function update_table_row($table, $data, $where_row, $where_value) {
	$connection = connect_to_database();

	$set_clause = format_assoc_to_pairs($connection, $data);

	if (!is_numeric($where_value)) {
		$where_value = "'" . mysqli_real_escape_string($connection, $where_value) . "'";
	}

	$sql_command = "UPDATE $table SET $set_clause WHERE $where_row = $where_value";
	echo $sql_command;
	return mysqli_query($connection, $sql_command);
}

function delete_table_row($table, $row_name, $value) {
	$connection = connect_to_database();

	$sql_command = "DELETE FROM $table WHERE $row_name = $value";

	return mysqli_query($connection, $sql_command);
}