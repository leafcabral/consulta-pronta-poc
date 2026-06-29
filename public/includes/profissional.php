<?php
	if (!isset($id_profissional)) { $id_profissional = "0"; }
	if (!isset($nome)) { $nome = "Profissional Não Identificado"; }
	if (!isset($crm)) { $crm = "000000"; }
	if (!isset($especialidades)) { $especialidades = "Geral"; }
	if (!isset($data_concessao)) { $data_concessao = "CONCESSAO"; }
	if (!isset($data_revogacao)) { $data_revogacao = null; }
	if (!isset($status)) { $status = "revogada"; }
	
    $is_active = ($status) == "ativa";
?>

<style> 
	@scope (article) {
		:scope {
			max-width: 400px;
			padding: 1em;
			border-radius: 6px;

			background-color: var(--color-surface);
			color: var(--color-text-dark);
            filter: drop-shadow(2px 4px 6px black);
		}

		header {
			display: flex;
			justify-content: space-between;

			h3 {
				margin-bottom: 6px !important;
			}
			
			p {
				height: fit-content;
				width: fit-content;
				padding: 2px 8px;
				border-radius: 10px;
				font-weight: bold;
				text-transform: capitalize;
			}
		}

		.ativa {
			background-color:  color-mix(in srgb, var(--color-success) 10%, transparent);
			color: var(--color-success);
		}

		.revogada {
			background-color:  color-mix(in srgb, var(--color-error) 10%, transparent);
			color: var(--color-error);
		}

		.esconder {
			display: none;
		}

		.content {
			margin-top: 6px;
		}

		.status-control {
			margin-top: 10px;
			width: fit-content;
			display: flex;
			align-items: center;
			gap: 10px;
            cursor: pointer;
			user-select: none;
		}

		.check-status {
            width: 16px;
            height: 16px;
		}
	}
</style>

<article class="light">
	<header>
		<h3><?= $nome ?></h3>
		<p id="status-<?= $id_profissional ?>" class="<?= $status ?>"><?=  ucfirst($status) ?></p>
	</header>
	<hr>
	<div class="content">
		<p><b><?= $especialidades ?></b> &bullet; <i>CRM <?= $crm ?></i></p>
		<p>Data da autorização: <?= $data_concessao ?></p>
		<p
			class="<?= empty($data_revogacao) ? 'esconder' : '' ?>"
			id="data-revogacao-<?= $id_profissional ?>"
		>
			Data da revogação: <?= $data_revogacao ?>
		</p>
		
		<label class="status-control">
			<input
				type="checkbox" name="status"
				data-id="<?= $id_profissional ?>"
				class="check-status"
				onchange="atualizar_autorizacao(this)"
				<?= $status == "ativa" ? "checked" : "" ?>
			>
			<span>Autorizado</span>
		</label>
	</div>

	<script>
		async function atualizar_autorizacao(checkbox) {
			const id = checkbox.dataset.id
			const novoStatus = checkbox.checked ? "ativa" : "revogada"

			const dados = await fetch(`/api/atualizar_status_profissional.php?id=${id}&status=${novoStatus}`)
			const resultado = await dados.json()
			
			if (resultado.sucesso) {
				const statusTag = document.getElementById(`status-${id}`)
				statusTag.innerText = novoStatus
				statusTag.className = novoStatus
				const revogacaoTag = document.getElementById(`data-revogacao-${id}`)
				revogacaoTag.innerText = `Data da revogação: ${resultado.data_revogacao}`
				revogacaoTag.className = checkbox.checked ? "esconder" : ""

			} else {
				checkbox.checked = !checkbox.checked
			}
		}
	</script>
</article>