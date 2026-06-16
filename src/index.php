<?php include_once "includes/config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tarefa 6</title>
	<link rel="stylesheet" href="styles/style.css">
</head>
<body>
	<?php
		if (empty($_SESSION["logado"])) {
			header("Location: " . PAGE_URL . "/auth/login.php");
			exit;
		} else {
			header("Location: " . PAGE_URL . "/" . $_SESSION["tipo_usuario"]);
		}
	?>

	<main>
		<h1>Placeholder</h1>
		<h2>Made to place your holder</h2>
	</main>
</body>
</html>