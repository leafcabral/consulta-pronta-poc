<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/global.php";
verify_user_logged_in();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/assets/icons/icon.png" type="image/x-icon">
	<title>Dashboard - ConsultaPronta</title>
	<link rel="stylesheet" href="/assets/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
</head>
<body>
	<?php require_once COMPONENTS . "aside.php" ?>

	<main>
		<header>
			<h1>Dashboard</h1>
			<h2>Seja bem vindo, <?= get_user($_SESSION["id_usuario"])["nome"] ?></h2>
		</header>

		<section id="dashboard_content">
			<article class="dark" id="prescricoes">
				<h3>Prescrições</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "prescricao", "Não há prescrições") ?>
				</div>
			</article>

			<article class="dark" id="consultas">
				<h3>Consultas próximas</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "consulta", "Não há consultas marcadas", true) ?>
				</div>
			</article>

			<article class="dark" id="exames">
				<h3>Exames</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "exame", "Não há exames") ?>
				</div>
			</article>

			<article class="dark" id="sintomas">
				<h3>Sintomas recentes</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "sintoma", "Não há sintomas registrados") ?>
				</div>
			</article>
		</section>
	</main>
</body>
</html>
