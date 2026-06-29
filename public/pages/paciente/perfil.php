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
		.containerhead {
			display: grid;
			gap: 20px;
		}
		.perfil{
			display: flex;
			align-items: center;
			justify-content: center;
			width: 400px;
			margin: 50px auto 10px;
			padding: 5px 10px;
		}
		.containermid {
			margin-top: 30px;
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;
		}
		.info {
			background-color: var(--color-surface);
			color: var(--color-background);
			border-radius: 10px;
			padding: 5px;
    		margin: 5px 10px 5px 0px;
		}
		.titulo {
			display: flex;
			gap: 10px;
			color: var(--color-surface);
			margin: 0px 10px 0px 0px;
			cursor: pointer;
		}
		.seta {
			font-size: 18px;
			transition: transform 0.3s;
		}
		.seta.aberta {
			transform: rotate(90deg);
		}
		.conteudo {
			display: none;
		}
		.conteudo.ativo {
			display: block;
		}
		button{
			background-color: transparent;
			color: var(--color-surface);
			border: none;
			cursor: pointer;
			font-weight: 700;
		}
	 </style>
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Meu Perfil</h1>
		</header>

		<div class="containerhead">
			<div class="perfil">
				<h1><?= $user_info["nome"] ?></h1>
			</div>
		</div>

		<div class="containermid">
			<section id="dados_pessoais">
				<div class="titulo" onclick="toggleSecao('pessoais')">
					<span class="seta">▶</span>
					<h3>Dados pessoais:</h3>
				</div>
				<!-- <button onclick="abrir_edicao('Editar Dados Pessoais', 'dados_pessoais')">Editar</button> -->
				<div class="info conteudo" id="pessoais">
					<?php 
						render_profile_field("CPF", "cpf", $user_info["cpf"]);
						render_profile_field("Email", "email", $user_info["email"]);
						render_profile_field("Data de nascimento", "data_nascimento", $patient_info["data_nascimento"]);
						render_profile_field("Conta criada em", "data_cadastro", $user_info["data_cadastro"]);
					?>
				</div>
				
			</section>

			<section id="dados_saude">
				<div class="titulo" onclick="toggleSecao('saude')">
					<span class="seta">▶</span>
					<h3>Dados de saúde:</h3>
					<button onclick="abrir_edicao('Editar Dados de Saúde', 'dados_saude')">Editar</button>
				</div>
				
				<div class="info conteudo" id="saude">
					<?php 
						render_profile_field("Altura (cm)", "altura", $patient_info["altura"]);
						render_profile_field("Peso (kg)", "peso", $patient_info["peso"]);
						render_profile_field("Tipo sanguíneo", "tipo_sanguineo", $patient_info["tipo_sanguineo"]);
						render_profile_field("Alergias", "alergias", $patient_info["alergias"]);
						render_profile_field("Doenças", "doencas", $patient_info["doencas"]);
						render_profile_field("Histórico Familiar", "historico_familiar", $patient_info["historico_familiar"]);
					?>
				</div>
				
			</section>
		
			<section id="dados_contato">
				<dialog id="editar_dados">
					<article class="dark">
						<span class="seta">▶</span>
						<h3>Editar dados: </h3>
						<form action="atualizar_perfil.php" method="post">
							<input id="secao" type="hidden" name="secao" value="">
							<input id="operacao" type="hidden" name="operacao" value="editar">
							
							<fieldset></fieldset>
					
							<button type="submit">Salvar</button>
							<button type="button" onclick="fechar_overlay('editar')">Fechar</button>
						</form>
					</article>
				</dialog>

				<dialog id="adicionar_dados">
					<article class="dark">

						<span class="seta">▶</span>
						<h3>Adicionar dados: </h3>
						
						<form action="atualizar_perfil.php" method="post">
							<input id="secao" type="hidden" name="secao" value="">
							<input id="operacao" type="hidden" name="operacao" value="adicionar">
							
							<fieldset>
								<label for="input_nome">Qual o nome da forma de contato?</label>
								<input type="text" id="input_nome" name="tipo" value="">

								<label for="input_valor">Qual é a forma  de contato?</label>
								<input type="text" id="input_valor" name="valor" value="">
							</fieldset>

							<button type="submit">Adicionar</button>
							<button type="button" onclick="fechar_overlay('adicionar')">Fechar</button>
						</form>
					</article>
				</dialog>
					<div class="titulo" onclick="toggleSecao('contato')">

					<span class="seta">▶</span>

					<h3>Dados de contato:</h3>

					<section>

						<button onclick="event.stopPropagation(); abrir_edicao('Editar Dados de Contato', 'dados_contato')">
							Editar
						</button>

						<button onclick="event.stopPropagation(); abrir_adicionar('Adicionar Dados de Contato', 'dados_contato')">
							Adicionar
						</button>

					</section>

				</div>
				
				<div class="info" id="contato">
					<?php
						foreach ($contacts as $contact) {
							$tipo = $contact["tipo"];
							$valor = $contact["valor"];
							render_profile_field($contact["tipo"], strtolower($contact["tipo"]), $contact["valor"]);
						}
					?>
				</div>
				
			</section>
		</div>

	<script>
		const overlayEditar = document.getElementById('editar_dados')
		const overlayAdicionar = document.getElementById('adicionar_dados')

		function abrir_edicao(titulo, secaoID) {
			const formSection = overlayEditar.querySelector("input#secao")
			const formTitle = overlayEditar.querySelector("h3")
			const formInputs = overlayEditar.querySelector("fieldset")

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

			overlayEditar.showModal();
		}

		function abrir_adicionar(titulo, secaoID) {
			const formSection = overlayAdicionar.querySelector("input#secao")
			const formTitle = overlayAdicionar.querySelector("h3")

			formTitle.innerText = titulo
			formSection.value = secaoID

			overlayAdicionar.showModal();
		}
		
		function fechar_overlay(operacao) {
			switch (operacao) {
				case "editar":
					overlayEditar.close();
					break
				case "adicionar":
					overlayAdicionar.close();
					break
			}
		}

		function toggleSecao(id){

			const conteudo = document.getElementById(id)

			const titulo = conteudo.previousElementSibling

			const seta = titulo.querySelector(".seta")


			conteudo.classList.toggle("ativo")

			seta.classList.toggle("aberta")
		}
	</script>
</body>
</html>
