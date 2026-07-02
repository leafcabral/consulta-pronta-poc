<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/global.php";
verify_user_logged_in();

$profissionais = get_patient_professionals_html($_SESSION["id_usuario"]);
if (empty($profissionais)) {
	$profissionais = "<p class='mensagem'>Nenhum profissional encontrado.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/assets/icons/icon.png" type="image/x-icon">
	<title>Seus Profisisonais - ConsultaPronta</title>
	<link rel="stylesheet" href="/assets/styles/style.css">
	<style>
		#busca {
			width: 250px;
			padding: 10px;
			border-radius: 6px;
		}

		#lista {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
			gap: 10px;
		}

		.hidden {
			display: none;
		}
	</style>
</head>
<body>
	<?php require_once COMPONENTS . "aside.php" ?>

	<main>
		<header>
			<h1>Seus Profissionais</h1>
			<h2>Edite as permissões dos seus profissionais</h2>
		</header>

		<input type="search" id="busca" placeholder="Busque por profissionais">

		<br><br>

		<section id="lista">
			<?= $profissionais ?>
		</section>
	</main>


	<script src="/assets/scripts/script.js"></script>
	<script>
		const busca = document.getElementById("busca");
		const lista = document.getElementById("lista");
		const nenhumResultado = document.getElementById("nenhum-resultado");

		function filtrarProfissionais() {
			const termo = (busca?.value || "").trim().toLowerCase();
			const cards = Array.from(lista?.querySelectorAll("article") || []);
			let visiveis = 0;

			cards.forEach((card) => {
				const textoBusca = (card.dataset.search || "").toLowerCase();
				const deveMostrar = textoBusca.includes(termo);
				card.classList.toggle("hidden", !deveMostrar);
				if (deveMostrar) visiveis++;
			});

			nenhumResultado.classList.toggle("hidden", visiveis !== 0);
		}

		busca?.addEventListener("input", filtrarProfissionais);
		filtrarProfissionais();
	</script>
</body>
</html>
