<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php" ?>

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
<style>
	section#dashboard_content_visu {
	display: grid;
	grid-template-areas:
		"re_dores dores"
		"lorem ipsum dores";
	grid-template-columns: 1fr 1fr;
	gap: 1em;
	height: min(500px, 60vh);
	}
</style>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Dashboard</h1>
			<h2>Seja bem vindo, <?= get_user_by_id($_SESSION["id_usuario"])["nome"] ?></h2>
		</header>

		<section id="dashboard_content_visu">
			<article class="dark" id="re_dores">
				<h3>Relatório</h3>
				<h2>Dores</h2>
				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "triagem", "Não há triagens") ?>
				</div>
			</article>

			<article class="dark" id="lorem ipsum">
				<h3>Relatório</h3>
				<h2>Lorem Ipsum</h2>
				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "relatorios", "Não há relatórios") ?>
				</div>
			</article>

			<article class="dark" id="dores">
				<h1>Dores</h1>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "pacientes", "Não há pacientes passados") ?>
				</div>
			</article>
		</section>
	</main>
</body>
</html>
