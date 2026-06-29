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
	}
</style>


<aside>
	<div id="aside_up">
		<a href="/pages/profissional">Página Inicial</a>
		<a href="/pages/profissional/exame.php">Exames</a>
		<a href="/pages/profissional/relatorios.php">Relatórios</a>
		<a href="/pages/profissional/prescricao.php">Farmácia</a>
	</div>

	<div id="aside_bottom">
		<a href="/pages/profissional/perfil.php">Perfil</a>
		<a href="/sair.php">Sair</a>
	</div>
</aside>