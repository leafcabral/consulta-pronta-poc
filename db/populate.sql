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
(1, 'Dor de cabeça forte que não passa', 7, '2026-06-21 08:00:00', 'Cabeça', 'ativo'),
(1, 'Corpo mole e muito cansaço', 6, '2026-06-21 10:00:00', 'Corpo todo', 'ativo'),
(1, 'Muita dor na garganta ao engolir', 8, '2026-06-22 07:00:00', 'Garganta', 'ativo'),

(2, 'Falta de ar leve', 5, '2026-06-21 09:30:00', 'Peito', 'ativo'),
(2, 'Chieira no peito e tosse seca', 6, '2026-06-21 22:00:00', 'Peito', 'ativo'),
(2, 'Nariz escorrendo e espirros', 4, '2026-06-22 06:00:00', 'Nariz', 'ativo'),

(3, 'Dor lombar crônica', 4, '2025-06-01 10:00:00', 'Costas', 'inativo'),
(3, 'Pontada na batata da perna esquerda', 5, '2025-06-03 14:00:00', 'Perna', 'inativo'),
(3, 'Dificuldade para levantar da cama de manhã', 6, '2025-06-05 06:30:00', 'Coluna', 'inativo');

INSERT INTO autorizacao (id_paciente, id_profissional, data_concessao, data_revogacao, status) VALUES 
(1, 4, '2026-06-20', NULL, 'ativa'),
(2, 4, '2026-06-21', NULL, 'ativa'),
(3, 4, '2025-06-01', '2026-01-01', 'revogada');

INSERT INTO prescricao (id_paciente, id_profissional, medicamento, frequencia, duracao, data_emissao, orientacoes_uso) VALUES 
(
	1, 4, 'Antitérmico 500mg', 
	'De 6 em 6 horas', 'Se houver febre',  '2026-06-20', 
	'Tomar apenas se a febre estiver acima de 37.8°C.'
),
(
	1, 4, 'Amoxicilina 500mg', 
	'De 8 em 8 horas', 'Por 7 dias', '2026-06-22', 
	'Tomar mesmo que os sintomas sumirem. Antibiótico para tratar a infecção da garganta.'
),
(
	2, 4, 'Inalador de resgate (Aerolin)', 
	'Em caso de crise', 'Uso contínuo', '2026-06-21', 
	'Usar 2 jatos se houver falta de ar ou chieira. Associado ao tempo seco.'
),
(
	3, 4, 'Anti-inflamatório 100mg', 
	'De 12 em 12 horas', 'Por 5 dias', '2025-06-02', 
	'Tomar sempre após as refeições. Tratamento para dor pós-esforço repetitivo.'
),
(
	3, 4, 'Complexo B (Suplemento)', 
	'1 vez ao dia', 'Por 30 dias', '2025-06-05', 
	'Tomar pela manhã junto com o café. Auxilia na regeneração e dores musculares da perna.'
);

INSERT INTO exame (id_paciente, id_profissional, titulo, tipo, descricao_resultado, data_resultado) VALUES 
(1, 4, 'PCR Quantitativo', 'Sangue', 'Elevado, indicando processo inflamatório', '2026-06-22'),
(2, 4, 'Espirometria', 'Respiratório', 'Capacidade pulmonar dentro do esperado para asmáticos', '2026-06-23'),
(3, 4, 'Radiografia de Coluna', 'Imagem', 'Leve desgaste na região lombar L4-L5', '2025-06-05');

INSERT INTO relatorio (id_paciente, data_geracao, titulo, periodo_inicio, perido_fim, dados_analiticos) VALUES 
(
	1, '2026-06-20', 
	'Febre ruim do nada',
	'2026-06-20', '2026-06-20', 
	'Comecei a queimar de febre e ter calafrios logo depois do almoço.'
),
(
	1, '2026-06-24', 
	'Gripe que pegou pesado',
	'2026-06-21', '2026-06-24', 
	NULL
),
(
	2, '2026-06-24', 
	'Crise de asma atacada',
	'2026-06-21', '2026-06-24', 
	NULL
),
(
	3, '2025-06-30', 
	'Coluna travada e perna doendo',
	'2025-06-01', '2025-06-30', 
	'Senti as costas travadas o mês inteiro e começou a puxar uma dor chata na perna.'
);

INSERT INTO anotacao_clinica (id_profissional, id_relatorio, data_hora, texto_evolucao, hipotese_diagnostica) VALUES 
(4, 1, '2026-06-24 10:00:00', 'Febre cessou nas últimas 24 horas.', 'Infecção Viral a Esclarecer'),
(4, 2, '2026-06-24 11:15:00', 'Orientei sobre gatilhos alérgicos no ambiente.', 'Asma Intermitente'),
(4, 3, '2025-06-30 16:30:00', 'Alta do tratamento agudo, recomendado fisioterapia.', 'Lombalgia Mecânica');

INSERT INTO consulta (id_paciente, id_profissional, data_hora, status, motivo) VALUES
(1, 4, '2026-06-20 15:00:00', 'realizada', 'Consulta de rotina acompanhamento febre'),
(2, 4, '2026-07-05 09:00:00', 'agendada', 'Avaliação de crise asmática recente'),
(3, 4, '2025-05-25 11:30:00', 'cancelada', 'Retorno de exames de rotina lombar');