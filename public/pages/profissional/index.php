<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/global.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/assets/icons/icon.png" type="image/x-icon">
	<title>Dashboard - ConsultaPronta</title>
	<link rel="stylesheet" href="/assets/styles/style.css">
	<link rel="stylesheet" href="profissional.css">
</head>
<body>
	<?php require_once COMPONENTS . "asideProfissional.php" ?>

	<main>
		<header>
			<h1>Dashboard</h1>
			<h2>Seja bem vindo, <?= get_user_by_id($_SESSION["id_usuario"])["nome"] ?></h2>
		</header>

		<section id="dashboard_content_profissional">
			<article class="dark" id="prescricoes">
				<h3>Triagem</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "triagem", "Não há triagens") ?>
				</div>
			</article>

			<article class="dark" id="consultas">
				<h3>Relatórios</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "relatorios", "Não há relatórios") ?>
				</div>
			</article>

			<article class="dark" id="sintomas">
				<h3>Pacientes Passados</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "pacientes", "Não há pacientes passados") ?>
				</div>
			</article>
		</section>
	</main>
</body>
</html>
