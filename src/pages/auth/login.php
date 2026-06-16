<?php include_once "../../includes/config.php" ?>

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

	<form action="post">
		<fieldset>
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" placeholder="teste@teste.com" required>
		</fieldset>


		<fieldset>
			<label for="senha">Senha:</label>
			<input type="password" name="senha" id="senha" placeholder="123456" required>
		</fieldset>

		<button type="submit">Entrar</button>
	</form>
</body>
</html>