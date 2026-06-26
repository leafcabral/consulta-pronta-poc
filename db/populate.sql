USE consultapronta_poc;

INSERT INTO usuario (nome, cpf, email, senha_hash, tipo_usuario, data_cadastro) VALUES 
(
	'Carlos Souza', '11122233344', 'carlos@email.com',
	'55a5e9e78207b4df8699d60886fa070079463547b095d1a05bc719bb4e6cd251', -- senha123
	'paciente', '2026-01-10'
),
(
	'Mariana Lima', '22233344455', 'mariana@email.com',
	'b703ea3295874bc05ba073570656a8fb73b50e08502f676451e70e9a41639d67', -- mariana2026
	'paciente', '2026-02-15'
),
(
	'Roberto Alves', '33344455566', 'roberto@email.com',
	'4c0d3de764ff4b245781a54e9990b79313db093b12368944f77c387063161c28', -- robertoOld
	'paciente', '2025-05-20'
),
(
	'Marcos Mendes', '44455566677', 'marcos.mendes@clinica.com',
	'2cf24dba5fb0a30e26e83b2ac5b9e29e1b161e5c1fa7425e73043362938b9824', -- hello
	'profissional', '2025-01-01'
);

INSERT INTO contato (id_usuario, tipo, valor) VALUES 
(1, 'Celular', '(11) 99999-1111'),
(1, 'E-mail', 'carlos.trabalho@email.com'),
(2, 'Celular', '(11) 99999-2222'),
(3, 'Celular', '(21) 98888-3333'),
(4, 'Comercial', '(11) 3333-4444');

INSERT INTO paciente (id_paciente, data_nascimento, altura, peso, alergias, historico_familiar, doencas, tipo_sanguineo) VALUES 
(1, '1990-04-12', 180, 85.0, 'Nenhuma', 'Pai diabético', 'Nenhuma', 'A+'),
(2, '1995-08-22', 165, 60.2, 'Penicilina', 'Mãe com histórico de câncer', 'Asma', 'O-'),
(3, '1970-12-05', 172, 90.1, 'Aspirina', 'Nenhum relevante', 'Hipertensão', 'AB+');

INSERT INTO profissional (id_profissional, crm, especialidades) VALUES 
(4, '555666-ES', 'Pediatria, Endocrinologia');

INSERT INTO sintoma (id_paciente, descricao, intensidade, data_inicio, local, status) VALUES 
(1, 'Febre alta e calafrios', 8, '2026-06-20 14:00:00', 'Corpo todo', 'ativo'),
(2, 'Falta de ar leve', 5, '2026-06-21 09:30:00', 'Peito', 'ativo'),
(3, 'Dor lombar crônica', 4, '2025-06-01 10:00:00', 'Costas', 'inativo');

INSERT INTO autorizacao (id_paciente, id_profissional, data_concessao, data_revogacao, status) VALUES 
(1, 4, '2026-06-20', NULL, 'ativa'),
(2, 4, '2026-06-21', NULL, 'ativa'),
(3, 4, '2025-06-01', '2026-01-01', 'revogada');

INSERT INTO prescricao (id_paciente, id_profissional, medicamentos, orientacoes_uso, data_emissao, dados) VALUES 
(1, 4, 'Antitérmico 500mg', 'Tomar se febre acima de 37.8°C', '2026-06-20', 'Histórico: Paciente relatou início de febre na noite anterior.'),
(2, 4, 'Inalador de resgate', 'Usar 2 jatos em caso de crise', '2026-06-21', 'Histórico: Uso contínuo associado ao tempo seco.'),
(3, 4, 'Anti-inflamatório 100mg', 'Tomar por 5 dias após as refeições', '2025-06-02', 'Histórico: Tratamento pós-esforço repetitivo.');

INSERT INTO exame (id_paciente, id_profissional, titulo, tipo, descricao_resultado, data_resultado) VALUES 
(1, 4, 'PCR Quantitativo', 'Sangue', 'Elevado, indicando processo inflamatório', '2026-06-22'),
(2, 4, 'Espirometria', 'Respiratório', 'Capacidade pulmonar dentro do esperado para asmáticos', '2026-06-23'),
(3, 4, 'Radiografia de Coluna', 'Imagem', 'Leve desgaste na região lombar L4-L5', '2025-06-05');

INSERT INTO relatorio (id_paciente, data_geracao, titulo, periodo_analisado, dados_analiticos) VALUES 
(1, '2026-06-24', 'Evolução Quadro Infeccioso', 'Junho 2026', 'Paciente respondeu bem ao tratamento inicial.'),
(2, '2026-06-24', 'Acompanhamento de Asma', 'Junho 2026', 'Crises controladas com uso correto da medicação.'),
(3, '2025-06-30', 'Histórico de Dor Crônica', 'Junho 2025', 'Paciente reportou melhora, caso encerrado neste período.');

INSERT INTO anotacao_clinica (id_profissional, id_relatorio, data_hora, texto_evolucao, hipotese_diagnostica) VALUES 
(4, 1, '2026-06-24 10:00:00', 'Febre cessou nas últimas 24 horas.', 'Infecção Viral a Esclarecer'),
(4, 2, '2026-06-24 11:15:00', 'Orientei sobre gatilhos alérgicos no ambiente.', 'Asma Intermitente'),
(4, 3, '2025-06-30 16:30:00', 'Alta do tratamento agudo, recomendado fisioterapia.', 'Lombalgia Mecânica');