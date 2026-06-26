<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";

$erro = "";
$form_enviado = ($_SERVER["REQUEST_METHOD"] == "POST");

if ($form_enviado) {
	$email = get_post("email");
	$senha = get_post("senha_hash");

	$usuario = get_user($email);
	if (empty($usuario)) {
		$erro = "Usuário não existe";
	} elseif ($senha !== $usuario["senha_hash"]) {
		$erro = "Senha incorreta";
	} else {
		$_SESSION["logado"] = true;
		$_SESSION["id_usuario"] = $usuario["id_usuario"];
		$_SESSION["tipo_usuario"] = $usuario["tipo_usuario"];

		header("Location: /pages/" . $_SESSION["tipo_usuario"]);
		exit();
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
		if (!empty($erro)) {
			echo "<p style='color: red;'>$erro</p>";
		}
	?>
	<form method="post" name="form">
		<fieldset class="simple_input">
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" placeholder="teste@teste.com" required>
		</fieldset>


		<fieldset class="simple_input">
			<label for="senha">Senha:</label>
			<input type="password" name="senha_hash" id="senha_hash" hidden>
			<input type="password" name="senha" id="senha" placeholder="123456" required>
		</fieldset>

		<a href="cadastro.php">Não possui conta?</a>
		<button type="submit">Entrar</button>
	</form>

	<script src="/scripts/script.js"></script>
	<script>
		document.form.addEventListener("submit", async (event) => {
			event.preventDefault();

			this.senha_hash.value = await hash(this.senha.value);

			document.form.submit();
		})
	</script>
</body>
</html>