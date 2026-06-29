<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/config/global.php";
verify_user_logged_in();
if (empty($_GET["id"])) { http_response_code(400); }

$relatorio = get_report($_GET["id"]);
extract($relatorio);
$anotacoes = get_report_notes($id_relatorio);
$sintomas = get_symptoms_by_period($id_paciente, $periodo_inicio, $perido_fim);;

if (!empty($dados_analiticos)) {
	$dados_analiticos = nl2br(htmlspecialchars($dados_analiticos));
}

$inicio = new DateTime($periodo_inicio);
$fim = new DateTime($perido_fim);
$duracao = $inicio->diff($fim)->days + 1;

function data_para_string_legal($data) {
	$meses = [
		1 => 'janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
		'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'
	];
	$timestamp = strtotime($data);

	$dia = date('d', $timestamp);
	$mes_numero = (int) date('m', $timestamp);
	$ano = date('Y', $timestamp);
	
	return "{$dia} de {$meses[$mes_numero]} de {$ano}";
}


?>

<h2 class="titulo-relatorio"><?= $titulo ?></h2>
<p><i>Relatório ID-<?= $id_relatorio ?></i></p>
<br>
<p><b>Período: </b>
	<?= data_para_string_legal($periodo_inicio) ?> até 
	<?= data_para_string_legal($perido_fim) ?>
</p>
<p><b>Duração: </b> <?= $duracao ?> dias</p>

<br><hr><br>

<h4>Minhas observações na época</h4>
<?php if (!empty($dados_analiticos)): ?>
	<p><?= $dados_analiticos ?></p>
<?php else: ?>
	<p class="mensagem">Você não adicionou observações extras ao gerar este relatório.</p>
<?php endif; ?>

<br>

<h4>Avaliação do Profissional de Saúde</h4>
<?php if (!empty($anotacoes)): ?>
	<?php
		foreach ($anotacoes as $anotacao) {
			$nome = get_user_by_id($anotacao["id_profissional"])["nome"];

			echo "
				<p><i>({$anotacao['data_hora']})</i> $nome</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;{$anotacao['texto_evolucao']}</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;Hipotese: {$anotacao['hipotese_diagnostica']}</p>
			";
		}
	?>
<?php else: ?>
	<p class="mensagem">Nenhum profissional de saúde adicionou anotações a este relatório ainda.</p>
<?php endif; ?>

<br>

<h4>Sintomas registrados nesse período</h4>
<?php if (!empty($sintomas)): ?>
	<ul style="list-style: none; padding: 10px 0; display: flex; flex-direction: column; gap: 8px;">
		<?php
			foreach ($sintomas as $sintoma) {
				echo get_rendered_template(ROOT."/includes/sintoma.php", $sintoma);
			}
		?>
	</ul>
<?php else: ?>
	<p class="mensagem">Nenhum sintoma foi registrado por você durante este período.</p>
<?php endif; ?>