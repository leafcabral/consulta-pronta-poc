<?php
	if (!isset($id_relatorio)) { $id_relatorio = "0"; }
	if (!isset($id_paciente)) { $id_paciente = "0"; }
	// if (!isset($data_geracao)) { $data_geracao = "0000-00-00"; }
	if (!isset($titulo)) { $titulo = "Relatório"; }
	if (!isset($periodo_inicio)) { $periodo_inicio = "0000-00-00"; }
	if (!isset($perido_fim)) { $perido_fim = "0000-00-00"; }
	if (!isset($dados_analiticos)) { $dados_analiticos = null; }
?>

<style> 
	@scope (article) {
		:scope {
			padding: 1em;
			border-radius: 6px;
			filter: drop-shadow(2px 4px 6px black);
			cursor: pointer;
		}

		header {
			display: flex;
			justify-content: space-between;
			align-items: center;

			h3 {
				margin: 0;
				font-size: 1.2rem;
			}

			&.anotado::after {
				display: inline;
				content: "Possui anotações";
				padding: 2px 8px;
				border-radius: 10px;
				font-weight: bold;

				background-color: color-mix(in srgb, var(--color-neutral) 10%, transparent);
				color: var(--color-neutral);
			}
		}

		hr {
			margin: 10px 0;
		}
	}
</style>

<article class="light" data-id="<?= $id_relatorio ?>">
	<header class="<?= ($dados_analiticos != null) ? "anotado" : "" ?>">
		<h3><?= htmlspecialchars($titulo) ?></h3>
	</header>

	<hr>

	<div class="content">
		<p><strong>Início dos sintomas:</strong> <?= date('d/m/Y', strtotime($periodo_inicio)) ?></p>
		<p><strong>Fim dos sintomas:</strong> <?= date('d/m/Y', strtotime($perido_fim)) ?></p>
	</div>
</article>