<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";

	verify_user_logged_in();

	$user_info = get_user_by_id($_SESSION["id_usuario"]);
	$patient_info = get_patient($_SESSION["id_usuario"]);
	$contacts = get_user_contacts($_SESSION["id_usuario"]);
	unset(
		$user_info["id_usuario"],
		$user_info["senha_hash"],
		$user_info["tipo_usuario"],
		$patient_info["id_paciente"]
	);

	// (\d{3}) -> 3 digitos
	// (\d{2}) -> 2 digitos
	$cpf_pattern = "/(\d{3})(\d{3})(\d{3})(\d{2})/";
	// 111.222.333-44
	$replacement = "$1.$2.$3-$4";
	$user_info["cpf"] = preg_replace($cpf_pattern, $replacement, $user_info["cpf"]);

	$data_hora = new DateTime($user_info["data_cadastro"]);
	$user_info["data_cadastro"] = $data_hora->format("d/m/Y");
	$data_hora = new DateTime($patient_info["data_nascimento"]);
	$patient_info["data_nascimento"] = $data_hora->format("d/m/Y");
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/icons/icon.png" type="image/x-icon">
	<title>Perfil - ConsultaPronta</title>
	<link rel="stylesheet" href="/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"> -->
	 <style>
		dialog {
			align-self: center;
			justify-self: center;
			background: 0;
			border: 0;
			filter: drop-shadow(2px 4px 6px black);
			width: 50vw;
		}

		dialog::backdrop {
			background-color: rgba(0,0,0, 0.5);
		}
	 </style>
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1><?= $user_info["nome"] ?></h1>
			<h2>Seu perfil</h2>
		</header>

		<section>
			<h3>Dados pessoais:</h3>
			<button onclick="editar_dados_pessoais()">Editar</button>
			<p>CPF: <?= $user_info["cpf"] ?></p>
			<p>Email: <?= $user_info["email"] ?></p>
			<p>Data de nascimento: <?= $patient_info["data_nascimento"] ?></p>
			<p>Conta criada em <?= $user_info["data_cadastro"] ?></p>
		</section>
		
		<br>
		
		<section>
			<h3>Dados de saúde:</h3>
			<button onclick="editar_dados_saude()">Editar</button>
			<p>Altura: <?= $patient_info["altura"] ?></p>
			<p>Peso: <?= $patient_info["peso"] ?></p>
			<p>Tipo sanguíneo: <?= $patient_info["tipo_sanguineo"] ?></p>
			<p>Alergias: <?= $patient_info["alergias"] ?></p>
			<p>Doenças: <?= $patient_info["doencas"] ?></p>
			<p>Histórico Familiar: <?= $patient_info["historico_familiar"] ?></p>
		</section>
		
		<br>
		
		<section>
			<h3>Dados de contato:</h3>
			<button onclick="editar_dados_contato()">Editar</button>
			<p>
				<?php
					foreach ($contacts as $contact) {
						echo "<p>" . $contact["tipo"] . ": " . $contact["valor"] . "</p>";
					}
				?>
				</p>
		</section>

		<dialog id="editar_dados">
			<article class="dark">
				<h3>Editar dados: </h3>
				
				<label for="coisa">Coisa:</label>
				<input type="text" value="das">

				<br>
				<button onclick="fechar_overlay()">Fechar</button>
			</article>
		</dialog>
	</main>

	<script>
		const overlay = document.getElementById('editar_dados');

		function abrir_overlay() {
			overlay.showModal();
		}
		function fechar_overlay() {
			overlay.close();
		}

		function editar_dados_pessoais() {
			abrir_overlay()
		}

		function editar_dados_saude() {
			abrir_overlay()
		}

		function editar_dados_contato() {
			abrir_overlay()
		}
	</script>
</body>
</html>
