<?php
	if (!isset($descricao)) { $descricao = "Dor"; }
	if (!isset($intensidade)) { $intensidade = "6"; }
	if (!isset($data_inicio)) { $data_inicio = "1967-09-04 06:07:09"; }
	if (!isset($local)) { $local = "Pescoço"; }
	if (!isset($status)) { $status = "ativo"; }

	$data_hora = new DateTime($data_inicio);
?>

<article class="light">
	<p>
		<?= ($status == "ativo") ? "&#128994;" : "&#128309;"?>
		<?= htmlspecialchars($descricao) ?>
	</p>
	<hr>
	<p>Intensidade: <?= $intensidade ?>/10</p>
	<p>Data de Inicio: <?= $data_hora->format("H:i - d/m/Y") ?></p>
	<p>Local: <?= htmlspecialchars($local) ?></p>
</article>