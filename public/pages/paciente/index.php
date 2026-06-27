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
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Dashboard</h1>
			<h2>Seja bem vindo, <?= "PLACEHOLDER" ?></h2>
		</header>

		<section id="dashboard_content">
			<article class="dark" id="prescricoes">
				<h3>Prescrições</h3>

				<div class="lista">
					<?php
						$prescricoes = get_patient_data($_SESSION["id_usuario"], "prescricao");
						if (empty($prescricoes)) {
							echo "<p class=\"mensagem\">Não há prescrições</p>";
						} else {
							foreach ($prescricoes as $prescricao) {
								echo "<article class=\"light\">". implode(", ", $prescricao) ."</article>";
							}
						}
					?>
				</div>
			</article>

			<article class="dark" id="consultas">
				<h3>Consultas próximas</h3>

				<div class="lista">
					<?php
						$consultas = get_patient_data($_SESSION["id_usuario"], "consulta");
						if (empty($sintomas)) {
							echo "<p class=\"mensagem\">Não há consultas marcadas</p>";
						} else {
							foreach ($consultas as $consulta) {
								echo "<article class=\"light\">". implode(", ", $consulta) ."</article>";
							}
						}
					?>
				</div>
			</article>

			<article class="dark" id="sintomas">
				<h3>Sintomas recentes</h3>

				<div class="lista">
					<?php
						$sintomas = get_patient_data($_SESSION["id_usuario"], "sintoma");
						if (empty($sintomas)) {
							echo "<p class=\"mensagem\">Não há sintomas registrados</p>";
						} else {
							foreach ($sintomas as $sintoma) {
								echo "<article class=\"light\">". implode(", ", $sintoma) ."</article>";
							}
						}
					?>
				</div>
			</article>
		</section>
	</main>
</body>
</html>
