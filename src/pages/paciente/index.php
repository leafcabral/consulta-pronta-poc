<?php include_once "../../includes/config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?= SRC_URL ?>/icons/icon.png" type="image/x-icon">
	<title>Dashboard</title>
	<link rel="stylesheet" href="<?= SRC_URL ?>/styles/style.css">
</head>
<body>
	<?php require_once "../../includes/aside.php" ?>

	<main>
		<header>
			<h1>Dashboard</h1>
			<h2>Seja bem vindo, <?= "PLACEHOLDER" ?></h2>
		</header>

		<section>
			<style>
				@scope {
					:scope {
						display: grid;
						grid-template-areas: 
							"remedios sintomas"
							"consultas sintomas";
						gap: 1em;
					}
				}
			</style>

			<article class="dark">
				<style> @scope {
					:scope {
						grid-area: remedios;
					}
				} </style>
				<p>Prescrições</p>

				<div>
					<p>Das</p>
					<p>Das</p>
					<p>Das</p>
				</div>
			</article>

			<article class="dark">
				<style> @scope {
					:scope {
						grid-area: consultas;
					}
				} </style>
				<p>Consultas próximas</p>

				<div>
					<p>Das</p>
					<p>Das</p>
					<p>Das</p>
				</div>
			</article>

			<article class="dark">
				<style> @scope {
					:scope {
						grid-area: sintomas;
						display: flex;
						flex-direction: column;
						justify-content: space-between;
					}

					div {
						display: flex;
						flex-direction: column;
						width: 100%;
						gap: 0.5em;
					}

					div > article {
						border-radius: 8px;
					}
				} </style>
				<p>Sintomas recentes</p>

				<div>
					<article class="light">Das</article>
					<article class="light">Das</article>
					<article class="light">Das</article>
				</div>
			</article>
		</section>
	</main>
</body>
</html>
