<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";
verify_user_logged_in();

$form_enviado = ($_SERVER["REQUEST_METHOD"] == "POST");

if ($form_enviado) {
	$id_usuario = $_SESSION["id_usuario"];
	$titulo = get_post("titulo");
	$periodo_inicio = get_post("data_inicio");
	$periodo_fim = get_post("data_fim");
	$extra = get_post("dados");

	add_new_report($id_usuario, date("Y-m-d"), $titulo, $periodo_inicio, $periodo_fim, $extra);
	
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
	<title>Seus relatórios - ConsultaPronta</title>
	<link rel="stylesheet" href="/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
	<style>
		body main {
			display: flex;
			flex-direction: column;
			padding-bottom: 0;
		}

		dialog {
			background-color: transparent;
			border: 0;
			align-self: center;
			justify-self: center;
			
			&::backdrop {
				background: rgba(0, 0, 0, 0.2);
			}
		}

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
			width: 320px;
			padding: 0;
			border: none;

			input {
				width: stretch;
			}
		}

		input, select, textarea, button {
			padding: 0.5em 1em;
			width: fit-content;
		}

		.input_wrapper {
			display: flex;
			align-items: center;
			gap: 16px
		}
		
		button {
			background-color: var(--color-accent);
			color: var(--color-text-dark);
			border-radius: 6px;
			
			&:hover {
				filter: brightness(0.8);
			}
		}
		
		section#content {
			display: flex;
			flex-direction: row;
			gap: 20px;
			width: stretch;
			height: stretch;
			align-self: center;
    		min-height: 0;
		}

		#lista {
			display: flex;
			flex-direction: column;
			gap: 10px;
			width: 400px;
			min-height: 0;
			overflow-y: auto;
		}

		#relatorio {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-grow: 1;
			border-radius: 6px;

			& .mensagem {
				width: fit-content;
			}

			& #relatorio-content {
				width: 100%;
				height: 100%;
			}
		}

		section#header {
			display: flex;
			flex-direction: row;
			align-items: center;
			gap: 16px;
    		align-self: center;
		}
	</style>
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/aside.php" ?>

	<main>
		<header>
			<h1>Seus Relatório</h1>
			<h2>Visualize e gere novos</h2>
		</header>

		<section id="header">
			<input type="text" id="inputrelatorios" placeholder="Buscar relatorios">
			<button onclick="mostrarOverlay()"><b>Gerar novo relatório</b></button>
		</section>

		<br>

		<dialog id="gerar_relatorio">
			<article class="dark">
				<form method="post">
					<fieldset>
						<label for="titulo">Titulo do relatório</label>
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

					<fieldset>
						<label for="dados">Observações</label>
						<input type="text" name="dados" id="dados" placeholder="Insira informações extras">
					</fieldset>
			
					<div>
						<button type="submit">Gerar</button>
						<button type="button" onclick="fecharOverlay()">Fechar</button>
					</div>
				</form>
			</article>
		</dialog>

		<section id="content">
			<section id="lista">
				<?= get_patient_reports_html($_SESSION["id_usuario"]) ?>
			</section>
			<section id="relatorio">
				<p class="mensagem" id="relatorio-mensagem">Clique em algum relatório para visualiza-lo</p>
				<div id="relatorio-content" hidden></div>
			</section>
		</section>
	</main>

	<script>
		const laylay = document.getElementById("gerar_relatorio")

		function mostrarOverlay() {
			laylay.showModal()
		}
		function fecharOverlay() {
			laylay.close()
		}

		function atualizarIntensidadeAtual(event) {
			const amostradinho = document.getElementById("intensidade_atual")
			amostradinho.innerText = event.currentTarget.value
		}

		async function carregarRelatorio(id_relatorio) {
			const relatorio = document.getElementById("relatorio-content")
			const mensagem = document.getElementById("relatorio-mensagem")
			mensagem.innerHTML = "Carregando relatório..."

			try {
				const resposta = await fetch(`/api/relatorio_completo.php?id=${id_relatorio}`)
				if (!resposta.ok) throw new Error("Erro na requisição")
				
				const htmlRelatorio = await resposta.text()
				
				relatorio.innerHTML = htmlRelatorio
				mensagem.hidden = true
				relatorio.hidden = false
			} catch (erro) {
				relatorio
				mensagem.innerText = "Erro ao carregar os detalhes do relatório. Tente novamente."
				mensagem.hidden = false
				relatorio.hidden = true

				console.error(erro)
			}
		}

		document.addEventListener("DOMContentLoaded", () => {
			const relatorios = document.querySelectorAll("#lista > article")
			relatorios.forEach(relatorio => {
				relatorio.addEventListener("click", () => {
					carregarRelatorio(relatorio.dataset.id)
				})
			});
		})
	</script>
</body>
</html>
