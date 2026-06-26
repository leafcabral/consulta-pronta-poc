<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";

$erro = "";
$form_enviado = ($_SERVER["REQUEST_METHOD"] == "POST");

if ($form_enviado) {
	$tipo = get_post("tipo");
	$nome = get_post("nome");
	$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
	$cpf = get_post("cpf");
	$senha = get_post("senha");
	$senha_confirmar = get_post("senha_confirmar");
	$termos = get_post("termos");

	$data_nasc = "2000-06-07";
	$altura = 1.1;
	$peso = 1.6;

	if ($tipo && $nome && $email && $senha) {
		$user_checked = check_if_user_exists($tipo, $email, $cpf);
	
		$conta_existe = (isset($user_checked["cpf"]) || isset($user_checked["email"])) ? true : false;

		if ($senha != $senha_confirmar) {
			$erro = "Senhas digitadas estão diferentes";
		} elseif (!$termos) {
			$erro = "É necessário concordar com os termos para usar o ConsultaPronta";
		} elseif ($conta_existe) {
			$erro = (isset($user_checked["cpf"])) ? "Usuário com esse CPF já existe" : "Usuário com esse email já existe";
		} else {
			$_SESSION["logado"] = true;
			$_SESSION["id_usuario"] = add_new_pacient($nome, $cpf, $email, $senha, date("Y-m-d"), $data_nasc, $altura, $peso, "", "", "", "");
			$_SESSION["tipo_usuario"] = $tipo;
			echo $_SESSION["id_usuario"];
			// header("Location: ../$tipo/index.php");
			// exit();
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
	<link rel="shortcut icon" href="/icons/icon.png" type="image/x-icon">
	<title>ConsultaPronta</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<img src="/icons/logo.png" alt="logo consulta pronta" id="logo">

	<?php
	echo "`teste`";
	echo "'teste'";

		if (!empty($erro)) {
			echo "<p style='color: red;'>$erro</p>";
		}
	?>
	<form method="post" name="form">
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
			<label for="cpf">CPF:</label>
			<input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" required>
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

	<script src="/scripts/script.js"></script>
	<script>
		document.getElementById('cpf').addEventListener('input', function(e) {
			e.target.value = format_cpf(e.target.value)
		});


		document.addEventListener("submit", async (event) => {
			event.preventDefault();
			
			this.senha_hash.value = await hash(this.senha.value);

			document.form.submit();
		})
	</script>
</body>
</html>