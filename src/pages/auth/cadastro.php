<?php
include_once "../../includes/config.php";

$erro = "";
$form_enviado = ($_SERVER["REQUEST_METHOD"] == "POST");

if ($form_enviado) {
	$tipo = filter_input(INPUT_POST, "tipo");
	$nome = filter_input(INPUT_POST, "nome");
	$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	$senha = filter_input(INPUT_POST, "senha");
	$senha_confirmar = filter_input(INPUT_POST, "senha_confirmar");
	$termos = filter_input(INPUT_POST, "termos");

	if ($tipo && $nome && $email && $senha) {
		if ($senha != $senha_confirmar) {
			$erro = "Senhas digitadas estão diferentes";
		} elseif (!$termos) {
			$erro = "É necessário concordar com os termos para usar o ConsultaPronta";
		} elseif (false /* TESTE */) {
			$erro = "Conta já existe.";
		} else {
			$_SESSION["logado"] = true;
			$_SESSION["id_usuario"] = 1;
			$_SESSION["tipo_usuario"] = $tipo;

			header("Location: ../$tipo/index.php");
			exit();
		}
	} else {
		$erro = "Inputs preenchidos incorretamente.";
	}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?= SRC_URL ?>/icons/icon.png" type="image/x-icon">
	<title>ConsultaPronta</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<img src="<?= SRC_URL ?>/icons/logo.png" alt="logo consulta pronta" id="logo">

	<?php
		if (!empty($erro)) {
			echo "<p style='color: red;'>$erro</p>";
		}
	?>
	<form method="post">
		<fieldset id="tipo">
			<input type="radio" name="tipo" id="paciente" value="paciente" checked>
			<label for="paciente">Paciente</label>
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="tipo" id="profissional" value="profissional">
			<label for="profissional">Profissional</label>
		</fieldset>

		<fieldset class="simple_input">
			<label for="email">Nome:</label>
			<input type="text" name="nome" id="nome" placeholder="Geraldo Sorvete" required>
		</fieldset>

		<fieldset class="simple_input">
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" placeholder="teste@teste.com" required>
		</fieldset>


		<fieldset class="simple_input">
			<label for="senha">Senha:</label>
			<input type="password" name="senha" id="senha" placeholder="123456" required>
		</fieldset>

		<fieldset class="simple_input">
			<label for="senha_confirmar">Confirmar Senha:</label>
			<input type="password" name="senha_confirmar" id="senha_confirmar" placeholder="Mesma da anterior" required>
		</fieldset>

		<fieldset>
			<input type="checkbox" name="termos" id="termos">
			<label for="termos">Li e aceito os Termos de Uso e a Política de Privacidade</label>
		</fieldset>

		<a href="login.php">Já possui conta?</a>
		<button type="submit">Entrar</button>
	</form>
</body>
</html>