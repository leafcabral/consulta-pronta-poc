<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/config/global.php";
verify_user_logged_in();
if (empty($_GET["id"])) { http_response_code(400); exit; }

$id_relatorio = intval($_GET["id"]);
$relatorio = get_report($id_relatorio);
if (empty($relatorio)) {
	http_response_code(404);
	exit;
}

if (is_paciente()) {
	if ($relatorio["id_paciente"] != $_SESSION["id_usuario"]) {
		http_response_code(403);
		exit;
	}
} elseif (is_profissional()) {
	if (!professional_can_view_report($_SESSION["id_usuario"], $id_relatorio)) {
		http_response_code(403);
		exit;
	}
}

extract($relatorio);
$anotacoes = get_report_notes($id_relatorio);
$sintomas = get_symptoms_by_period($id_paciente, $periodo_inicio, $perido_fim);

if (!empty($dados_analiticos)) {
	$dados_analiticos = nl2br(htmlspecialchars($dados_analiticos));
}

$inicio = new DateTime($periodo_inicio);
$fim = new DateTime($perido_fim);
$duracao = $inicio->diff($fim)->days + 1;

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
				<p>&emsp;{$anotacao['texto_evolucao']}</p>
				<p>&emsp;Hipotese: {$anotacao['hipotese_diagnostica']}</p>
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