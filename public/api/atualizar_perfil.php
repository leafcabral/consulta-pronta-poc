<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/config/global.php";
verify_user_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$id_usuario = $_SESSION["id_usuario"];
	$secao = isset($_POST["secao"]) ? $_POST["secao"] : "";
	$operacao = $_POST["operacao"];
	unset($_POST["secao"]);
	unset($_POST["operacao"]);

	switch ($operacao) {
		case "editar":
			if ($secao == "dados_saude") { update_patient_data($id_usuario, $_POST); }
			elseif ($secao == "dados_contato") { update_patient_contacts($id_usuario, $_POST); }
			break;
		case "adicionar":
			if ($secao == "dados_saude") {}
			elseif ($secao == "dados_contato") { add_new_contact($id_usuario, $_POST["tipo"], $_POST["valor"]); }
			break;
		case "solicitar_alteracao_email":
			$novo_email = filter_input(INPUT_POST, "novo_email", FILTER_VALIDATE_EMAIL);
			$confirmar_email = filter_input(INPUT_POST, "confirmar_email", FILTER_VALIDATE_EMAIL);
			$usuario_atual = get_user_by_id($id_usuario);

			if ($novo_email && $confirmar_email && $novo_email === $confirmar_email) {
				if ($novo_email !== $usuario_atual["email"] && user_exists("email", $novo_email)) {
					$_SESSION["mensagem_perfil"] = "Este e-mail já está em uso.";
				} else {
					$_SESSION["pending_email_change"] = $novo_email;
					$_SESSION["mensagem_perfil"] = "Confirme a alteração para $novo_email.";
				}
			} else {
				$_SESSION["mensagem_perfil"] = "Os e-mails informados não conferem ou são inválidos.";
			}
			break;
		case "confirmar_alteracao_email":
			$novo_email = isset($_SESSION["pending_email_change"]) ? $_SESSION["pending_email_change"] : null;
			if (!empty($novo_email)) {
				if (update_user_email($id_usuario, $novo_email)) {
					unset($_SESSION["pending_email_change"]);
					$_SESSION["mensagem_perfil"] = "E-mail alterado com sucesso.";
				} else {
					$_SESSION["mensagem_perfil"] = "Não foi possível alterar o e-mail.";
				}
			} else {
				$_SESSION["mensagem_perfil"] = "Nenhuma alteração de e-mail pendente.";
			}
			break;
		default: // cooked
	}
}

header("Location: ../pages/" . $_SESSION["tipo_usuario"] . "/perfil.php");
exit();