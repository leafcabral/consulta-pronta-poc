<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";
verify_user_logged_in();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/icons/icon.png" type="image/x-icon">
	<title>Seus Profisisonais - ConsultaPronta</title>
	<link rel="stylesheet" href="/styles/style.css">
	<style>
		#busca {
			width: 250px;
			padding: 10px;
			border-radius: 6px;
		}

		#lista {
			display: flex;
			flex-direction: column;
			gap: 10px;
		}
	</style>
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Seus Profissionais</h1>
			<h2>Edite as permissões dos seus profissionais</h2>
		</header>

		<input type="search" id="busca" placeholder="Busce por profissionais">

		<br><br>

		<section id="lista">
			<?= get_patient_professionals_html($_SESSION["id_usuario"]) ?>
		</section>
	</main>
</body>
</html>
