<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";
verify_user_logged_in();

$form_enviado = ($_SERVER["REQUEST_METHOD"] == "POST");

if ($form_enviado) {
	$id_usuario = $_SESSION["id_usuario"];
	$data_hora = date("Y-m-d H:i");
	$titulo = get_post("titulo");
	$periodo = get_post("data_inicio") . "," . get_post("data_fim");

	add_new_report($id_usuario, $data_hora, $titulo, $periodo, "");

	header("Location: index.php");
	exit();
}

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
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Relatório</h1>
			<h2>Gera um relatório dos seus sintomas</h2>
		</header>

		<form method="post">
			<fieldset>
				<label for="descricao">Titulo do relatório</label>

				<input type="text" name="titulo" id="titulo" placeholder="Insira um titulo descritivo" required>
			</fieldset>
			
			<fieldset>
				<p>Período</p>

				<div class="input_wrapper">
					<div>
						<label for="data_inicio">Data de inicio</label>
						<input type="date" name="data_inicio" id="data_inicio" required>
					</div>
					<div>
						<label for="data_fim">Data de fim</label>
						<input type="date" name="data_fim" id="data_fim" value="<?= date('Y-m-d') ?>" required>
					</div>
				</div>
			</fieldset>
			
			<button>Gerar</button>
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
