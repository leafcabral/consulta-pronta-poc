<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/global.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/icons/icon.png" type="image/x-icon">
	<title>Relatar Sintoma - ConsultaPronta</title>
	<link rel="stylesheet" href="/styles/style.css">
	<link rel="stylesheet" href="paciente.css">
	<style>
		table {
			width: fit-content;
			margin: 0 auto;
			border-radius: 15px;
			overflow: hidden;
			border-collapse: separate;
			border-spacing: 0;
			background-color: #F4EFE6;
			color: #2B254D;
		}
		th, td {
			padding: 10px 40px;
			border-bottom: 1px solid #231C44;
			text-align: center;
		}
		fieldset {
			display: flex;
			flex-direction: column;
			gap: 6px;
			width: 300px;
			padding: 0;
			border: none;
		}

		input, select, textarea, button {
			flex-grow: 1;
			padding: 0.5em;
		}

		.input_wrapper {
			display: flex;
			align-items: center;
			gap: 16px
		}
		
		button {
			width: 128px;
			background-color: var(--color-accent);
			color: var(--color-text-dark);
			border-radius: 6px;
			
			&:hover {
				filter: brightness(0.8);
			}
		}
		.pesquisa{
			display: flex;
			align-items: center;
			background-color: #F4EFE6;
			width: 600px;
			margin: 60px auto 20px;
			border-radius: 5px;
			padding: 5px 10px;
			color: #2B254D;
		}
		#inputpesquisa{
			border: none;
			background-color: transparent;
			width: 100%;
			outline: none;
		}
		.containerhead {
			display: grid;
			gap: 20px;
		}
		.botao-exame {
			border: 1px solid #2B254D;
			background-color: transparent;
			font-size: 14px;
    		width: 200px;
			border-radius: 15px;
		}
        .detalhes {
            display: none;
        }


        .detalhes.aberto {
            display: table-row;
        }


        .seta {
            cursor: pointer;
            display: inline-block;
            transition: .3s;
        }


        .rotacionada {
            transform: rotate(180deg);
        }
	</style>
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/asideProfissional.php" ?>

	<main>
		<header>
			<h1>Exame</h1>
		</header>
		<div class="containerhead">
			<div class="pesquisa">
				<span>⌕</span>
				<input type="text" id="inputpesquisa" placeholder="Buscar exames">
				<input type="button" class="botao-exame" value="⊕ Solicitar exame">
			</div>
		</div>
		
		<table>
			<tr>
				<th>Relatório</th>
				<th>ID</th>
				<th>Data</th>
				<th>Horário</th>
				<th></th>
			</tr>
			<tr>
				<td>Dores</td>
				<td>123456789/1242</td>
				<td>01/04/2026</td>
				<td>14:30</td>
				<td><span class="seta" onclick="abrirRelatorio(this)">⌄</span></td>
			</tr>
                <tr class="detalhes">
                <td colspan="5">
                    <button>⬇ Baixar relatório</button>
                    <button>🛡 Profissionais permitidos</button>
                    <button>✎ Renomear relatório</button>
                </td>
            </tr>
		</table>

	</main>

	<script>
		function abrirRelatorio(linha){

             let linha = seta.closest("tr");

            let detalhes = linha.nextElementSibling;


            detalhes.classList.toggle("aberto");

            seta.classList.toggle("rotacionada");

        }
	</script>
</body>
</html>
