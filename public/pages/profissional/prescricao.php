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
        form{
            background-color: #4D4A73;
            padding: 15px;
        }
		fieldset {
			display: flex;
			flex-direction: column;
			gap: 6px;
			width: 300px;
			padding: 0;
			border: none;
            background-color: #F4EFE6;
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

        section#periodos {
            display: grid;
            grid-template-areas:
                "n_comprimidos intervalo_horas"
                "quant_dias quant_dias";
            gap: 6px;
            width: 100%;
        }

        #n_comprimidos {
            grid-area: n_comprimidos;
        }

        #intervalo_horas {
            grid-area: intervalo_horas;
        }

        #quant_dias {
            grid-area: quant_dias;
        }

	</style>
</head>
<body>
	<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/asideProfissional.php" ?>

	<main>
		<header>
			<h1>Exame</h1>
		</header>
		
		<form method="post">
            <fieldset>
                <h1>Preescrever Medicamento</h1>
            </fieldset>
			<fieldset>
				<label for="descricao">Selecione o paciente</label>

				<select name="paciente" id="paciente" required>
					<option value="" disabled selected hidden>Selecione o Paciente</option>
					<option value="cláudio silva">Cláudio Silva</option>
					<option value="the robert">The Robert</option>
				</select>
			</fieldset>
			
            <fieldset>
				<label for="descricao">Escreva o Nome do medicamente</label>

				<input type="text" name="medicamento" id="medicamento" placeholder="medicamento" required>
			</fieldset>

            <fieldset>
				<label for="descricao">Selecione o tipo de consumo</label>

				<select name="consumo" id="consumo" required>
					<option value="" disabled selected hidden>Tipo de consumo</option>
					<option value="cláudio silva">Oral</option>
				</select>
			</fieldset>
			
			
			<fieldset>
				<label for="descricao">Preencha</label>
                
                <div id="periodos">
                    <input type="text" name="comprimidos" id="n_comprimidos" placeholder="Num. de comprimidos" required>
                    <input type="text" name="horas" id="intervalo_horas" placeholder="Intervalo de horas" required>
                    <input type="text" name="dias" id="quant_dias" placeholder="Quantidade de dias" required>
                </div>
				
			</fieldset>

			<button>Registrar</button>
		</form>

	</main>

	<script>
		
	</script>
</body>
</html>
