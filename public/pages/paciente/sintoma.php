<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/global.php";
verify_user_logged_in();

$form_enviado = ($_SERVER["REQUEST_METHOD"] == "POST");

if ($form_enviado) {
	$id_usuario = $_SESSION["id_usuario"];
	$descricao = get_post("descricao");
	$intensidade = get_post("intensidade");
	$data_hora = get_post("data") . " "  . get_post("hora");
	$local = get_post("local");

	add_new_symptom($id_usuario, $descricao, $intensidade, $data_hora, $local, "ativo");

	header("Location: index.php");
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/assets/icons/icon.png" type="image/x-icon">
	<title>Relatar Sintoma - ConsultaPronta</title>
	<link rel="stylesheet" href="/assets/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
	<style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 28px;
			width: fit-content;
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
	</style>
</head>
<body>
	<?php require_once COMPONENTS . "aside.php" ?>

	<main>
		<header>
			<h1>Sintoma</h1>
			<h2>Relate e descreva o seu sintoma</h2>
		</header>

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
		function atualizarIntensidadeAtual(event) {
			const amostradinho = document.getElementById("intensidade_atual")
			amostradinho.innerText = event.currentTarget.value
		}
	</script>
</body>
</html>
