<?php
	if (!isset($titulo)) { $titulo = "Hemograma completo"; }
	if (!isset($tipo)) { $tipo = "Sangue"; }
	if (!isset($descricao_resultado)) { $descricao_resultado = "Baixo número de plaquetas"; }
	if (!isset($data_resultado)) { $data_resultado = "1967-09-04 06:07:09"; }

	$data_resultado = new DateTime($data_resultado);
?>

<article class="light">
	<p>
		<?= htmlspecialchars($titulo) ?>
	</p>
	<hr>
    <p>Tipo de exame: <?= $tipo ?></p>
    <p>Resultado: <?= $descricao_resultado ?></p>
	<p>Data do reultado: <?= $data_resultado->format("H:i - d/m/Y") ?></p>
</article>