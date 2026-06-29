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
	<title>Dashboard - ConsultaPronta</title>
	<link rel="stylesheet" href="/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Dashboard</h1>
			<h2>Seja bem vindo, <?= get_user_by_id($_SESSION["id_usuario"])["nome"] ?></h2>
		</header>

		<section id="dashboard_content_visu">
			<article class="dark" id="relatorio1">
				<h3>relatorio</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "prescricao", "Não há prescrições") ?>
				</div>
			</article>
			<article class="dark" id="relatorio2">
				<h3>relatorio</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "prescricao", "Não há prescrições") ?>
				</div>
			</article>
			<article class="dark" id="visu">
				<h3>relatorio</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "prescricao", "Não há prescrições") ?>
				</div>
			</article>
		</section>
	</main>
</body>
</html>
