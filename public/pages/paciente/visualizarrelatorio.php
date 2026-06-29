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
	section#dashboard_content_rela {
		display: grid;
    	grid-template-areas:         
			"relatorio1 visu"        
			"relatorio1 visu";
		gap: 1em;
		height: min(250px, 60vh);
		grid-template-columns: 10fr 15fr;
		
	}

	section#notas{
		display: grid;
		flex-direction: column;
	}

	.relatorios {
		display: flex;
		flex-direction: column;
		background-color: #F4EFE6;
		color: #231C44;
	}
	
</style>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Meus Relatórios</h1>
		</header>

		<section id="dashboard_content_visu">
			<article class="relatorios" id="relatorio1">
				<h1>relatorio: Dores</h1>
				<h3>ID: 123456789/1242</h3>
				<h3>Data: 01/04/2026</h3>
				<h3>Horário: 14:00</h3>
			</article>
			<article class="dark" id="relatorio2">
				<h3>relatorio</h3>

				<div class="lista">
					<?= get_patient_data_html($_SESSION["id_usuario"], "prescricao", "Não há prescrições") ?>
				</div>
			</article>
			<article class="relatorios" id="visu">
				<h1>Dor nas costas constantes</h1>
				<h5>RELATORIO ID51966</h5>
				<h3>periodo: 10 de abril a 16 de abriel</h3>
				<h3>duração: 8 dias</h3>
				<h2>Cronologia dos Sintomas</h2>
				<section id="notas">

				</section>
			</article>
		</section>
	</main>
</body>
</html>
