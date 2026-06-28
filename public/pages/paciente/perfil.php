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
	
	function render_profile_field($label, $key, $value) {
		$html_label = htmlspecialchars($label);
		$html_key = htmlspecialchars($key);
		$html_value = htmlspecialchars($value);

		echo "<p data-key=\"$html_key\" data-value=\"$html_value\">";
		echo "$html_label: $html_value";
		echo "</p>";
	}
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

		fieldset {
			border: 0;
			padding: 0;
			display: grid;
			grid-template-columns: 1fr 1fr;
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

		<section id="dados_pessoais">
			<h3>Dados pessoais:</h3>
			<button onclick="abrir_edicao('Editar Dados Pessoais', 'dados_pessoais')">Editar</button>

			<?php 
				render_profile_field("CPF", "cpf", $user_info["cpf"]);
				render_profile_field("Email", "email", $user_info["email"]);
				render_profile_field("Data de nascimento", "data_nascimento", $patient_info["data_nascimento"]);
				render_profile_field("Conta criada em", "data_cadastro", $user_info["data_cadastro"]);
			?>
		</section>
		
		<br>
		
		<section id="dados_saude">
			<h3>Dados de saúde:</h3>
			<button onclick="abrir_edicao('Editar Dados de Saúde', 'dados_saude')">Editar</button>
			
			<?php 
				render_profile_field("Altura", "altura", $patient_info["altura"]);
				render_profile_field("Peso", "peso", $patient_info["peso"]);
				render_profile_field("Tipo sanguíneo", "tipo_sanguineo", $patient_info["tipo_sanguineo"]);
				render_profile_field("Alergias", "alergias", $patient_info["alergias"]);
				render_profile_field("Doenças", "doencas", $patient_info["doencas"]);
				render_profile_field("Histórico Familiar", "historico_familiar", $patient_info["historico_familiar"]);
			?>
		</section>
		
		<br>
		
		<section id="dados_contato">
			<h3>Dados de contato:</h3>
			<button onclick="abrir_edicao('Editar Dados de Contato', 'dados_contato')">Editar</button>
			
			<?php
				foreach ($contacts as $contact) {
					$tipo = $contact["tipo"];
					$valor = $contact["valor"];
					render_profile_field($contact["tipo"], strtolower($contact["tipo"]), $contact["valor"]);
				}
			?>
		</section>

		<dialog id="editar_dados">
			<article class="dark">
				<h3>Editar dados: </h3>
				
				<form action="atualizar_perfil.php" method="post">
					<input id="secao" type="hidden" name="secao" value="">
					
					<fieldset></fieldset>
				
					<br>
					<button type="submit">Salvar</button>
					<button type="button" onclick="fechar_overlay()">Fechar</button>
				</form>
			</article>
		</dialog>
	</main>

	<script>
		const overlay = document.getElementById('editar_dados');

		const formSection = overlay.querySelector("input#secao")
		const formTitle = overlay.querySelector("h3")
		const formInputs = overlay.querySelector("fieldset")

		function abrir_edicao(titulo, secaoID) {
			formTitle.innerText = titulo
			formSection.value = secaoID
			formInputs.innerHTML = ""
			
			const paragraphs = document.getElementById(secaoID)
				.querySelectorAll("p")
			
			paragraphs.forEach(p => {
				const key = p.dataset.key
				const value = p.dataset.value
				const label = p.innerText.split(':')[0].trim()

				if (key === 'data_cadastro' || key === 'cpf') return

				formInputs.innerHTML += `
					<label for="input_${key}">${label}: </label>
					<input type="text" id="input_${key}" name="${key}" value="${value}">
				`
			})

			overlay.showModal();
		}
		
		function fechar_overlay() {
			overlay.close();
		}
	</script>
</body>
</html>
