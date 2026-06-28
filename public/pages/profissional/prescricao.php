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
			width: 600px;
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
			gap: 20px;
		}
		.botao-exame {
			border: 1px solid #2B254D;
			background-color: transparent;
			font-size: 14px;
    		width: 200px;
			border-radius: 15px;
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
				<input type="button" class="botao-exame" value="⊕ Solicitar exame">
			</div>
		</div>
		
		<form method="post">
			<fieldset>
				<label for="descricao">O que você está sentindo</label>

				<input type="text" name="descricao" id="descricao" placeholder="Resuma seus sintomas" required>
			</fieldset>
			
			<fieldset>
				<p>Qual a intensidade do sintoma?</p>

				<div class="input_wrapper">
					<label for="intensidade" id="intensidade_atual">5</label>
					<input type="range" name="intensidade" id="intensidade" min="1" max="10" value="5" required oninput="atualizarIntensidadeAtual(event)">
				</div>
			</fieldset>
			
			<fieldset>
				<p>Qando começou?</p>

				<div class="input_wrapper">
					<input type="date" name="data" id="data" value="<?= date('Y-m-d') ?>">
					<input type="time" name="hora" id="hora" value="<?= date('H:i') ?>">
				</div>
			</fieldset>
			
			<fieldset>
				<label for="local">Em qual local do corpo?</label>

				<select name="local" id="local" required>
					<option value="" disabled selected hidden>Selecione o local</option>
					<option value="abdomen">Abdomen</option>
					<option value="barriga">Barriga</option>
					<option value="cabeca">Cabeça</option>
					<option value="costas">Costas</option>
					<option value="olhos">Olhos</option>
					<option value="pes">Pés</option>
					<option value="pescoco">Pescoço</option>
				</select>
			</fieldset>

			<button>Registrar</button>
		</form>

	</main>

	<script>
		
	</script>
</body>
</html>
