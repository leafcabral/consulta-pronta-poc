<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";
verify_user_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$id_usuario = $_SESSION["id_usuario"];
	$secao = $_POST['secao'];
	unset($_POST['secao']); 

	if ($secao === 'dados_saude') {
		update_patient_data($id_usuario, $_POST);
	} 
	elseif ($secao === 'dados_contato') {
		update_patient_contacts($id_usuario, $_POST);
	}
}

header("Location: perfil.php");
exit();