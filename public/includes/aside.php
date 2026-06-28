<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php"; ?>

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
	}W
</style>


<aside>
	<div id="aside_up">
		<a href="/pages/paciente">Página Inicial</a>
		<a href="/pages/paciente/sintoma.php">Registrar Sintoma</a>
		<a href="/pages/paciente/relatorio.php">Gerar Relatório</a>
	</div>

	<div id="aside_bottom">
		<a href="/pages/paciente/perfil.php">Perfil</a>
		<a href="/pages/profissional/index.php">profi</a>
		<a href="/pages/sair.php">Sair</a>
	</div>
</aside>