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
		gap: 10px;
		padding: 18px;
		border-radius: 18px;
		background-color: var(--color-surface);
		color: var(--color-background);
	}
	#re_dores {
		overflow: auto;
  		max-height: 150px; 
		scrollbar-width: none;
		cursor: pointer;
	}
	#re_dores::-webkit-scrollbar{
		display: none;
	}
	#lorem{
		display: none;
		overflow: auto;
		min-height: 400px; 
		scrollbar-width: none;
	}
	#lorem::-webkit-scrollbar {
		display: none;
	}
	#atualizações{
		display: grid;
		grid-template-columns: 1fr;
		gap: 15px;
		scrollbar-color: var(--color-accent) transparent;
	}
	.atuali_filhos{
		border: 1px solid var(--color-background);
		border-radius: 10px;
		padding: 10px
	}
	table {
		width: fit-content;
		overflow: hidden;
		background-color: transparent;
		gap: 10px
	}
	th, td {
		padding: 10px 40px;
		border: 1px solid var(--color-background);
		text-align: center;
	}
	h3 {
		margin-bottom: 0px;
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
				<h2>Relatório</h2>
				<h3>Dores</h3>
				<div>
					<label>ID: 123456789/1242</label>
					<div>
						<label>Data: 01/04/2026</label>
						<label>Horário: 14:00</label>
					</div>
				</div>
			</article>

			<article class="bloco" id="lorem" style="height: 450px">
				<div>
					<h1>Dores Constantes nas Costas</h1>
					<h2>Cláudio Silva</h2>
				</div>

				<div>
					<h3>CronoLogia do Sintoma</h3>
					<div id="atualizações">
						<div class="atuali_filhos">
							<h4>Dores ao levantar peso no trabalho</h4>
							<h5>16 abr. 2026</h5>
							<label>-  Intensidade 6/10; "Começa a doer um pouco despois de eu levantar, mas para de doer em pouco tempo."</label>
						</div>

						<div class="atuali_filhos">
							<h4>Dores ao levantar peso no trabalho</h4>
							<h5>16 abr. 2026</h5>
							<label>-  Intensidade 6/10; "Começa a doer um pouco despois de eu levantar, mas para de doer em pouco tempo."</label>
						</div>

						<div class="atuali_filhos">
							<h4>Dores ao levantar peso no trabalho</h4>
							<h5>16 abr. 2026</h5>
							<label>-  Intensidade 6/10; "Começa a doer um pouco despois de eu levantar, mas para de doer em pouco tempo."</label>
						</div>

						<div class="atuali_filhos">
							<h4>Dores ao levantar peso no trabalho</h4>
							<h5>16 abr. 2026</h5>
							<label>-  Intensidade 6/10; "Começa a doer um pouco despois de eu levantar, mas para de doer em pouco tempo."</label>
						</div>
					</div>
				</div>	

				<div>
					<h3>Cronologia do Sintoma</h3>
					<div>
						<table>
							<tr>
								<th>Sintoma</th>
								<th>Duraçao</th>
								<th>Ocorrência</th>
							</tr>
							<tr>
								<th>Dor nas costas</th>
								<th>20 Dias</th>
								<th>9 Ocorrências</th>
							</tr>
							<tr>
								<th>Estomâgo Ardendo</th>
								<th>4 Dias</th>
								<th>3 Ocorrências</th>
							</tr>
						</table>

					</div>
				</div>

			</article>
		</section>
	</main>
</body>

<script>
	const blocoRelatorio = document.getElementById("lorem");
	const blocoLista = document.getElementById("re_dores");

	blocoLista.addEventListener("click", () => {
		if (blocoRelatorio.style.display === "none") {
			blocoRelatorio.style.display = "flex";
		} else {
			blocoRelatorio.style.display = "none";
		}
	});
</script>

</html>
