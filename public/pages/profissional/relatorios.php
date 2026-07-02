<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/global.php";
verify_professional_logged_in();

$relatorios = get_professional_reports_html($_SESSION["id_usuario"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/icons/icon.png" type="image/x-icon">
    <title>Relatórios de Pacientes - ConsultaPronta</title>
    <link rel="stylesheet" href="/assets/styles/style.css">
    <link rel="stylesheet" href="profissional.css">
	<link rel="stylesheet" href="/assets/styles/reports.css">
</head>
<body>
    <?php require_once COMPONENTS . "asideProfissional.php" ?>

    <main>
        <header>
            <h1>Relatórios de Pacientes</h1>
            <h2>Pesquise e visualize relatórios dos seus pacientes</h2>
        </header>

        <section id="header">
            <input type="search" id="busca" placeholder="Buscar relatórios por paciente ou título">
        </section>

		<br>

        <section id="content">
			<?php if (!empty($relatorios)): ?>
				<section id="lista">
					<?= get_professional_reports_html($_SESSION["id_usuario"]) ?>
				</section>
				<section id="relatorio">
					<p class="mensagem" id="relatorio-mensagem">Clique em um relatório para visualizá-lo</p>
					<div id="relatorio-content" hidden></div>
				</section>
			<?php else: ?>
				<p class="mensagem">Nenhum relatório encontrado</p>
			<?php endif; ?>
        </section>
    </main>

    <script>
        const busca = document.getElementById("busca");
        const lista = document.getElementById("lista");
        const nenhumResultado = document.getElementById("nenhum-resultado");

        function filtrarRelatorios() {
            const termo = (busca?.value || "").trim().toLowerCase();
            const cards = Array.from(lista?.querySelectorAll("article") || []);
            let visiveis = 0;

            cards.forEach((card) => {
                const textoBusca = (card.dataset.search || "").toLowerCase();
                const deveMostrar = textoBusca.includes(termo);
                card.classList.toggle("hidden", !deveMostrar);
                if (deveMostrar) visiveis++;
            });

            nenhumResultado.classList.toggle("hidden", visiveis !== 0);
        }

        async function carregarRelatorio(id_relatorio) {
            const relatorio = document.getElementById("relatorio-content");
            const mensagem = document.getElementById("relatorio-mensagem");
            mensagem.innerHTML = "Carregando relatório...";
            mensagem.hidden = false;
            relatorio.hidden = true;

            try {
                const resposta = await fetch(`/api/relatorio_completo.php?id=${id_relatorio}`);
                if (!resposta.ok) throw new Error("Erro na requisição");

                const htmlRelatorio = await resposta.text();
                relatorio.innerHTML = htmlRelatorio;
                mensagem.hidden = true;
                relatorio.hidden = false;
            } catch (erro) {
                mensagem.innerText = "Erro ao carregar os detalhes do relatório. Tente novamente.";
                mensagem.hidden = false;
                relatorio.hidden = true;
                console.error(erro);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const relatorios = document.querySelectorAll("#lista > article");
            relatorios.forEach(relatorio => {
                relatorio.addEventListener("click", () => {
                    carregarRelatorio(relatorio.dataset.id);
                });
            });

            busca?.addEventListener("input", filtrarRelatorios);
            filtrarRelatorios();
        });
    </script>
</body>
</html>
