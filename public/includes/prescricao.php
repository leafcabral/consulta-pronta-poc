<?php
	if (!isset($medicamento)) { $medicamento = "Remédio"; }
	if (!isset($frequencia)) { $frequencia = "Tempo em tempo"; }
	if (!isset($duracao)) { $duracao = "Pra sempre"; }
	if (!isset($orientacoes_uso)) { $orientacoes_uso = "Evite o uso conjunto com bebidas alcólicas"; }
	if (!isset($data_emissao)) { $data_emissao = "1967-09-04 06:07:09"; }

	$data_emissao = new DateTime($data_emissao);
?>

<article class="light">
	<p><b><?= htmlspecialchars($medicamento) ?></b></p>
	<hr>
	<p><?= $frequencia ?> &bullet; <?= $duracao ?></p>
	<br>
    <i>
		<p>OBS.: <?= $orientacoes_uso ?></p>
		<p><small>Data de emissão: <?= $data_emissao->format("d/m/Y") ?></small></p>
	</i>
</article>