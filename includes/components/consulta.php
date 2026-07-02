<?php
	if (!isset($motivo)) { $motivo = "ConsultaPronta"; }
	if (!isset($status)) { $status = "agendada"; }
	if (!isset($data_hora)) { $data_hora = "1967-09-04 06:07:09"; }

	$data_hora = new DateTime($data_hora);
?>

<article class="light">
	<p>
		<?= htmlspecialchars($motivo) ?>
	</p>
	<hr>
    <p>Status da consulta: <?= $status ?></p>
	<p>Data da consulta: <?= $data_hora->format("H:i - d/m/Y") ?></p>
</article>