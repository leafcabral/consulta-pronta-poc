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
		"re_dores lorem"
		"lorem";
	grid-template-columns: 10fr 15fr;
	gap: 1em;
	height: min(150px, 60vh);
	}
	.bloco {
		padding: 18px;
		border-radius: 18px;
		background-color: var(--color-surface);
		color: var(--color-background);
	}
	#re_dores {
		overflow: auto;
  		max-height: 150px; 
	}
	#dores{
		overflow: auto;
  		max-height: 150px; 
	}
</style>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Relatórios</h1>
		</header>

		<section id="dashboard_content_visu">
			<article class="bloco" id="re_dores">
				<h3>Relatório</h3>
				<h2>Dores</h2>
				<div>
					<label>ID: 123456789/1242</label>
					<div>
						<label>Data: 01/04/2026</label>
						<label>Horário: 14:00</label>
					</div>
				</div>
			</article>

			<article class="bloco" id="lorem" style="height: 300px">
				<h3>Relatório</h3>
				<h2>Lorem Ipsum</h2>
				<div>
					<label>ID: 123456789/1242</label>
					<div>
						<label>Data: 01/04/2026</label>
						<label>Horário: 14:00</label>
					</div>
				</div>	
			</article>
		</section>
	</main>
</body>
</html>
