<?php include_once "config.php"; ?>

<style>
	@scope (aside) {
		:scope {
			background-color: var(--color-primary);
			padding: 2em 2em;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}

		#aside_up, #aside_bottom {
			display: flex;
			flex-direction: column;
			height: fit-content;
			gap: 0.5em;
		}

		a {
			color: white;
			text-decoration: none;
			padding: 10px;
			border-radius: 10px;
		}
		a:hover {
			background-color: #ffffff2e;
		}
	}
</style>


<aside>
	<div id="aside_up">
		<a href="<?= PAGE_URL ?>/paciente">Página Inicial</a>
		<a href="<?= PAGE_URL ?>/paciente/sintoma.php">Registrar Sintoma</a>
		<a href="<?= PAGE_URL ?>/paciente/relatorio.php">Gerar Relatório</a>
	</div>

	<div id="aside_bottom">
		<a href="<?= PAGE_URL ?>/paciente/perfil.php">Perfil</a>
	</div>
</aside>