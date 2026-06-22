<?php include_once "../../includes/config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?= SRC_URL ?>/icons/icon.png" type="image/x-icon">
	<title>Dashboard</title>
	<link rel="stylesheet" href="<?= SRC_URL ?>/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
</head>
<body>
	<?php require_once "../../includes/aside.php" ?>

	<main>
		<header>
			<h1>Dashboard</h1>
			<h2>Seja bem vindo, <?= "PLACEHOLDER" ?></h2>
		</header>

		<section id="dashboard_content">
			<article class="dark" id="prescricoes">
				<h3>Prescrições</h3>

				<div class="lista">
					<p class="mensagem">Não há prescrições</p>
				</div>
			</article>

			<article class="dark" id="consultas">
				<h3>Consultas próximas</h3>

				<div class="lista">
					<p class="mensagem">Não há consultas marcadas</p>
				</div>
			</article>

			<article class="dark" id="sintomas">
				<h3>Sintomas recentes</h3>

				<div class="lista">
					<article class="light">Das</article>
					<article class="light">Das</article>
					<article class="light">Das</article>
				</div>
			</article>
		</section>
	</main>
</body>
</html>
