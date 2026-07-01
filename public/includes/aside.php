<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php"; ?>
<link rel="stylesheet" href="/styles/defaults.css">
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
		<a href="/pages/paciente">
			<span class="material-symbols-rounded">home</span>
			Página Inicial
		</a>
		<a href="/pages/paciente/sintoma.php">
			<span class="material-symbols-rounded">monitor_heart</span>
			Registrar Sintoma
		</a>
		<a href="/pages/paciente/relatorios.php">
			<span class="material-symbols-rounded">assignment</span>
			Seus Relatórios
		</a>

		<a href="/pages/paciente/profissionais.php">
			<span class="material-symbols-rounded">groups</span>
			Seus Profissionais
		</a>
	</div>

	<div id="aside_bottom">
		<a href="/pages/paciente/perfil.php">
			<span class="material-symbols-rounded">account_circle</span>
			Perfil
		</a>
		<a href="/sair.php" style="color: var(--color-error);">
			<span class="material-symbols-rounded">logout</span>
			Sair
		</a>
	</div>
</aside>