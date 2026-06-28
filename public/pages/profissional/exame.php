<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/icons/icon.png" type="image/x-icon">
	<title>Relatar Sintoma - ConsultaPronta</title>
	<link rel="stylesheet" href="/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
	<style>
		table {
			width: fit-content;
			margin: 0 auto;
			border-radius: 15px;
			overflow: hidden;
			border-collapse: separate;
			border-spacing: 0;
			background-color: #F4EFE6;
			color: #2B254D;
		}
		th, td {
			padding: 10px 40px;
			border-bottom: 1px solid #231C44;
			text-align: center;
		}
		fieldset {
			display: flex;
			flex-direction: column;
			gap: 6px;
			width: 300px;
			padding: 0;
			border: none;
		}

		input, select, textarea, button {
			flex-grow: 1;
			padding: 0.5em;
		}

		.input_wrapper {
			display: flex;
			align-items: center;
			gap: 16px
		}
		
		button {
			width: 128px;
			background-color: var(--color-accent);
			color: var(--color-text-dark);
			border-radius: 6px;
			
			&:hover {
				filter: brightness(0.8);
			}
		}
		.pesquisa{
			display: flex;
			align-items: center;
			background-color: #F4EFE6;
			width: 500px;
			margin: 60px auto 20px;
			border-radius: 5px;
			padding: 5px 10px;
			color: #2B254D;
		}
		#inputpesquisa{
			border: none;
			background-color: transparent;
			width: 100%;
			outline: none;
		}
		.containerhead {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 20px;
		}
	</style>
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/asideProfissional.php" ?>

	<main>
		<header>
			<h1>Exame</h1>
		</header>
		<div class="containerhead">
			<div class="pesquisa">
				<span>⌕</span>
				<input type="text" id="inputpesquisa" placeholder="Buscar exames">
			</div>

			<button class="botao-exame">
				<span>⊕</span> Solicitar exame
			</button>
		</div>
		
		<table>
			<tr>
				<th>Exame</th>
				<th>Paciente</th>
				<th>Local</th>
				<th>Data</th>
				<th>Resultado</th>
			</tr>
			<tr>
				<td>Hemograma Completo</td>
				<td>Cláudio Silva</td>
				<td>Hospital Meridional Vitória</td>
				<td>06/07/2008</td>
				<td>Em Andamento</td>
			</tr>
			<tr>
				<td>Lipidiograma</td>
				<td>Cláudio Silva</td>
				<td>Hospital Meridional Vitória</td>
				<td>06/07/2008</td>
				<td>Em Andamento</td>
			</tr>
		</table>

	</main>

	<script>
		
	</script>
</body>
</html>
