CREATE DATABASE IF NOT EXISTS consultapronta_poc;
USE consultapronta_poc;

DROP TABLE IF EXISTS usuario;
CREATE TABLE usuario (
	id_usuario INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100),
	cpf VARCHAR(11),
	email VARCHAR(100),
	senha_hash CHAR(64), -- sha-265 hexadecimal
	tipo_usuario ENUM('paciente', 'profissional'),
	data_cadastro DATE
);

DROP TABLE IF EXISTS contato;
CREATE TABLE contato (
	id_contato INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_usuario INTEGER,
	tipo VARCHAR(20),
	valor VARCHAR(100),

	CONSTRAINT FK_CONTATO_id_usuario
		FOREIGN KEY (id_usuario)
		REFERENCES usuario(id_usuario)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS paciente;
CREATE TABLE paciente (
	id_paciente INTEGER PRIMARY KEY,
	data_nascimento DATE,
	altura SMALLINT,
	peso NUMERIC(5,2),
	alergias TEXT,
	historico_familiar TEXT,
	doencas TEXT,
	tipo_sanguineo VARCHAR(3),

	CONSTRAINT FK_PACIENTE_id_usuario
		FOREIGN KEY (id_paciente)
		REFERENCES usuario(id_usuario)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS profissional;
CREATE TABLE profissional (
	id_profissional INTEGER PRIMARY KEY,
	crm VARCHAR(10),
	especialidades TEXT,

	CONSTRAINT FK_PROFISSIONAL_id_usuario
		FOREIGN KEY (id_profissional)
		REFERENCES usuario(id_usuario)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS sintoma;
CREATE TABLE sintoma (
	id_sintoma INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_paciente INTEGER,
	descricao VARCHAR(300),
	intensidade SMALLINT,
	data_inicio TIMESTAMP,
	local VARCHAR(50),
	status ENUM('ativo', 'inativo') DEFAULT 'ativo',

	CONSTRAINT FK_SINTOMA_id_paciente
		FOREIGN KEY (id_paciente)
		REFERENCES paciente(id_paciente)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS autorizacao;
CREATE TABLE autorizacao (
	id_autorizacao INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_paciente INTEGER,
	id_profissional INTEGER,
	data_concessao DATE,
	data_revogacao DATE,
	status ENUM('ativa', 'revogada') DEFAULT 'ativa',

	CONSTRAINT FK_AUTORIZACAO_id_profissional
		FOREIGN KEY (id_profissional)
		REFERENCES profissional(id_profissional)
		ON DELETE CASCADE,
	CONSTRAINT FK_AUTORIZACAO_id_paciente
		FOREIGN KEY (id_paciente)
		REFERENCES paciente(id_paciente)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS prescricao;
CREATE TABLE prescricao (
	id_prescricao INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_paciente INTEGER,
	id_profissional INTEGER,
	medicamentos TEXT,
	orientacoes_uso VARCHAR(150),
	data_emissao DATE,
	dados TEXT,

	CONSTRAINT FK_PRESCRICAO_id_profissional
		FOREIGN KEY (id_profissional)
		REFERENCES profissional(id_profissional)
		ON DELETE CASCADE,
	CONSTRAINT FK_PRESCRICAO_id_paciente
		FOREIGN KEY (id_paciente)
		REFERENCES paciente(id_paciente)
		ON DELETE SET NULL
);

DROP TABLE IF EXISTS exame;
CREATE TABLE exame (
	id_exame INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_paciente INTEGER,
	id_profissional INTEGER,
	titulo VARCHAR(100),
	tipo VARCHAR(100),
	descricao_resultado VARCHAR(100),
	data_resultado DATE,

	CONSTRAINT FK_EXAME_id_paciente
		FOREIGN KEY (id_paciente)
		REFERENCES paciente(id_paciente)
		ON DELETE CASCADE,
	CONSTRAINT FK_EXAME_id_profissional
		FOREIGN KEY (id_profissional)
		REFERENCES profissional(id_profissional)
		ON DELETE SET NULL
);

DROP TABLE IF EXISTS relatorio;
CREATE TABLE relatorio (
	id_relatorio INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_paciente INTEGER,
	data_geracao DATE,
	titulo VARCHAR(100),
	periodo_analisado VARCHAR(30),
	dados_analiticos VARCHAR(200),

	CONSTRAINT FK_RELATORIO_id_paciente
		FOREIGN KEY (id_paciente)
		REFERENCES paciente(id_paciente)
		ON DELETE CASCADE
);

DROP TABLE IF EXISTS anotacao_clinica;
CREATE TABLE anotacao_clinica (
	id_anotacao INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_profissional INTEGER,
	id_relatorio INTEGER,
	data_hora TIMESTAMP,
	texto_evolucao VARCHAR(300),
	hipotese_diagnostica VARCHAR(100),

	CONSTRAINT FK_ANOTACAO_CLINICA_id_profissional
		FOREIGN KEY (id_profissional)
		REFERENCES profissional(id_profissional)
		ON DELETE SET NULL,
	CONSTRAINT FK_ANOTACAO_CLINICA_id_relatorio
		FOREIGN KEY (id_relatorio)
		REFERENCES relatorio(id_relatorio)
		ON DELETE CASCADE
);