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
	
	header("Location: " . $_SERVER['PHP_SELF']);
	exit();
}

$relatorios = get_patient_reports_html($_SESSION["id_usuario"]);

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
	<link rel="stylesheet" href="/styles/reports.css">
	<style>
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
			<input type="text" id="inputrelatorios" placeholder="Buscar relatórios">
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
			<?php if (!empty($relatorios)): ?>
				<section id="lista">
					<?= get_patient_reports_html($_SESSION["id_usuario"]) ?>
				</section>
				<section id="relatorio">
					<p class="mensagem" id="relatorio-mensagem">Clique em algum relatório para visualiza-lo</p>
					<div id="relatorio-content" hidden></div>
				</section>
			<?php else: ?>
				<p class="mensagem">Nenhum relatório encontrado</p>
			<?php endif; ?>
		</section>
	</main>

	<script src="/scripts/script.js"></script>
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
				const htmlRelatorio = await ReportAPI.get(id_relatorio)
				
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
		async function deletar_relatorio(id) {
			if (!confirm("Tem certeza que deseja deletar este relatório?")) return;

			try {
				await ReportAPI.delete(id);
				
				alert("Relatório deletado com sucesso!");
				location.reload();
			} catch (erro) {
				alert(erro.message);
				console.error(erro);
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

		const busca = document.getElementById("inputrelatorios");
		const nenhumResultado = document.getElementById("nenhum-resultado");

		function filtrarRelatorios() {
			const termo = (busca?.value || "").trim().toLowerCase();
			const cards = Array.from(document.querySelectorAll("#lista > article"));
			let visiveis = 0;

			cards.forEach((card) => {
				const textoBusca = (card.dataset.search || "").toLowerCase();
				const deveMostrar = textoBusca.includes(termo);
				card.classList.toggle("hidden", !deveMostrar);
				if (deveMostrar) visiveis++;
			});

			nenhumResultado.classList.toggle("hidden", visiveis !== 0);
		}

		busca?.addEventListener("input", filtrarRelatorios);
		filtrarRelatorios();
	</script>
</body>