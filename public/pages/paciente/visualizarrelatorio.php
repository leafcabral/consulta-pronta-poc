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
<style>
	section#dashboard_content_visu {
		display: grid;
    	grid-template-areas:         
			"relatorio1 visu"        
			"relatorio1 visu";
		gap: 1em;
		height: min(500px, 60vh);
		grid-template-columns: 10fr 15fr;
	}
	
</style>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Meus Relatórios</h1>
		</header>

		<section id="dashboard_content_visu">
			<article class="dark" id="relatorio1">
				<h3>relatorio: Dores</h3>
				<h2>ID: 123456789/1242</h2>
				<h2>Data: 01/04/2026</h2>
				<h2>Horário: 14:00</h2>
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
