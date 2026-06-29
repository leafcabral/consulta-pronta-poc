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
* {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #1e1b4b; /* Tom escuro de fundo */
            color: #333;
            padding: 20px;
        }

        /* Barra Superior */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container {
            flex-grow: 1;
            max-width: 600px;
            margin-right: 20px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 20px;
            border-radius: 25px;
            border: none;
            background-color: #f5efe6;
            font-size: 16px;
        }

        .btn-register {
            background-color: #3b3765;
            color: #fff;
            border: 1px solid #fff;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

        /* Barra de Filtros e Título */
        .toolbar {
            color: #fff;
            margin-bottom: 15px;
        }

        .filter-options {
            display: flex;
            gap: 15px;
            font-size: 14px;
            margin-bottom: 10px;
            color: #cbd5e1;
        }

        .toolbar h2 {
            font-size: 22px;
            font-weight: normal;
        }

        /* Layout Principal (Duas Colunas) */
        .main-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 20px;
            height: calc(100vh - 160px);
        }

        /* Coluna da Esquerda - Lista de Sintomas */
        .symptom-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            overflow-y: auto;
        }

        .symptom-card {
            background-color: #f5efe6;
            border-radius: 12px;
            padding: 15px;
            border-left: 5px solid transparent;
        }

        .symptom-card.active {
            border-left: 5px solid #2563eb; /* Destaque azul se necessário */
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .status-text {
            color: #e11d48;
            font-weight: bold;
        }

        .intensity-text {
            color: #b45309;
            font-weight: bold;
        }

        .card-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #1e1b4b;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #64748b;
        }

        .tag {
            background-color: #cbd5e1;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: bold;
            color: #1e1b4b;
        }

        /* Coluna da Direita - Detalhes do Sintoma */
        .symptom-detail {
            background-color: transparent;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .detail-actions {
            background-color: #f5efe6;
            border-radius: 12px;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-edit {
            background: none;
            border: none;
            font-size: 16px;
            font-weight: bold;
            color: #1e1b4b;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Histórico / Acordeon */
        .history-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
            overflow-y: auto;
        }

        .accordion-item {
            background-color: #f5efe6;
            border-radius: 12px;
            overflow: hidden;
        }

        .accordion-header {
            padding: 15px 20px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            cursor: pointer;
            color: #1e1b4b;
        }

        .accordion-content {
            padding: 20px;
        }

        .detail-intensity {
            color: #b45309;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .detail-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #1e1b4b;
        }

        .detail-description {
            font-size: 14px;
            color: #475569;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .attachment-box {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px;
            display: inline-block;
            background-color: #fff;
            margin-top: 10px;
        }

        .attachment-box img {
            max-height: 80px;
            display: block;
        }
    </style>
</head>
<body>

    <header class="top-bar">
        <div class="search-container">
            <input type="text" placeholder="🔍 Pesquisar sintoma">
        </div>
        <button class="btn-register">Registrar Sintoma <span>+</span></button>
    </header>

    <div class="toolbar">
        <div class="filter-options">
            <span>⏳ Filtrar ▼</span>
            <span>↕ Ordenar ▼</span>
        </div>
        <h2>4 Sintomas Registrados</h2>
    </div>

    <main class="main-container">

        <aside class="symptom-list">
            
            <article class="symptom-card active">
                <div class="card-header">
                    <span class="status-text">Sintoma Persistente</span>
                    <span class="intensity-text">⚡ Intensidade: 6/10</span>
                </div>
                <h3 class="card-title">Dor nas costas ao levantar peso no trabalho.</h3>
                <div class="card-footer">
                    <span>📅 14 de abr. de 2026</span>
                    <span class="tag">📍 Costas</span>
                </div>
            </article>

            <article class="symptom-card">
                <div class="card-header">
                    <span class="status-text">Sintoma Persistente</span>
                    <span class="intensity-text">⚡ Intensidade: 6/10</span>
                </div>
                <h3 class="card-title">Dor nas costas ao levantar peso no trabalho.</h3>
                <div class="card-footer">
                    <span>📅 14 de abr. de 2026</span>
                    <span class="tag">📍 Costas</span>
                </div>
            </article>

            <article class="symptom-card">
                <div class="card-header">
                    <span class="status-text">Sintoma Persistente</span>
                    <span class="intensity-text">⚡ Intensidade: 6/10</span>
                </div>
                <h3 class="card-title">Dor nas costas ao levantar peso no trabalho.</h3>
                <div class="card-footer">
                    <span>📅 14 de abr. de 2026</span>
                    <span class="tag">📍 Costas</span>
                </div>
            </article>

        </aside>

        <section class="symptom-detail">
            
            <div class="detail-actions">
                <button class="btn-back">←</button>
                <button class="btn-edit">📝 Editar Sintoma</button>
            </div>

            <div class="history-section">
                
                <div class="accordion-item">
                    <div class="accordion-header">
                        <span>📅 16 de abr. de 2026</span>
                        <span>▼</span>
                    </div>
                    <div class="accordion-content">
                        <div class="detail-intensity">⚡ Intensidade: 6/10</div>
                        <h3 class="detail-title">Dor nas costas ao levantar peso no trabalho</h3>
                        <p class="detail-description">
                            Começa a doer um pouco depois de eu levantar, mas para de doer em pouco tempo.
                        </p>
                        <span class="tag">📍 Costas</span>
                        
                        <div class="block">
                            <div class="attachment-box">
                                <img src="https://via.placeholder.com/60x80?text=Medicamento" alt="Foto do Medicamento">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <span>📅 7 de abr. de 2026</span>
                        <span>▼</span>
                    </div>
                </div>

            </div>
        </section>

    </main>

</body>
</html>