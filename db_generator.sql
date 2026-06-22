CREATE DATABASE IF NOT EXISTS consultapronta_poc;
USE consultapronta_poc;

CREATE TABLE IF NOT EXISTS paciente (
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
);

CREATE TABLE IF NOT EXISTS profissional (
    id_profissional INTEGER PRIMARY KEY,
    crm VARCHAR(10),
    especialidades TEXT,

    CONSTRAINT FK_PROFISSIONAL_id_usuario
        FOREIGN KEY (id_profissional)
        REFERENCES usuario(id_usuario);
);

CREATE TABLE IF NOT EXISTS sintoma (
    id_sintoma INTEGER PRIMARY KEY,
    id_paciente INTEGER,
    descricao VARCHAR(300),
    intensidade SMALLINT,
    data_inicio TIMESTAMP,
    local VARCHAR(50),
    status VARCHAR(15),

    CONSTRAINT FK_SINTOMA_id_paciente
        FOREIGN KEY (id_paciente)
        REFERENCES paciente(id_paciente);
);

CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INTEGER PRIMARY KEY,
    id_contato INTEGER,
    nome VARCHAR(100),
    cpf VARCHAR(11),
    email VARCHAR(100),
    senha_hash VARCHAR(255),
    tipo_usuario CHAR(2),
    data_cadastro DATE,

    CONSTRAINT FK_USUARIO_id_contato
        FOREIGN KEY (id_contato)
        REFERENCES contato(id_contato);
);

CREATE TABLE IF NOT EXISTS autorizacao (
    id_autorizacao INTEGER PRIMARY KEY,
    id_paciente INTEGER,
    id_profissional INTEGER,
    data_concessao DATE,
    data_revogacao DATE,
    status VARCHAR(15),

    CONSTRAINT FK_AUTORIZACAO_id_paciente
        FOREIGN KEY (id_profissional)
        REFERENCES profissional(id_profissional);
    CONSTRAINT FK_AUTORIZACAO_id_paciente
        FOREIGN KEY (id_paciente)
        REFERENCES paciente(id_paciente);
);

CREATE TABLE IF NOT EXISTS prescricao (
    id_prescricao INTEGER PRIMARY KEY,
    id_paciente INTEGER,
    id_profissional INTEGER,
    medicamentos TEXT,
    orientacoes_uso VARCHAR(,
    data_emissao DATE,
    data DATE,

    CONSTRAINT FK_PRESCRICAO_id_profissional
        FOREIGN KEY (id_profissional)
        REFERENCES profissional(id_profissional);
    CONSTRAINT FK_PRESCRICAO_id_paciente
        FOREIGN KEY (id_paciente)
        REFERENCES paciente(id_paciente);
);

CREATE TABLE IF NOT EXISTS exame (
    id_exame INTEGER PRIMARY KEY,
    id_paciente INTEGER,
    id_profissional INTEGER,
    titulo VARCHAR(100),
    tipo VARCHAR(100),
    descricao_resultado VARCHAR(100),
    data_resultado DATE,

    CONSTRAINT FK_EXAME_id_paciente
        FOREIGN KEY (id_paciente)
        REFERENCES paciente(id_paciente);
    CONSTRAINT FK_EXAME_id_profissional
        FOREIGN KEY (id_profissional)
        REFERENCES profissional(id_profissional);
);

CREATE TABLE IF NOT EXISTS contato (
    id_contato INTEGER PRIMARY KEY,
    tipo VARCHAR(20),
    valor VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS relatorio (
    id_relatorio INTEGER PRIMARY KEY,
    id_paciente INTEGER,
    id_anotacao INTEGER,
    data_geracao DATE,
    periodo_analisado VARCHAR(30),
    dados_analiticos VARCHAR(200),

    CONSTRAINT FK_RELATORIO_id_paciente
        FOREIGN KEY (id_paciente)
        REFERENCES paciente(id_paciente);
    CONSTRAINT FK_RELATORIO_id_anotacao
        FOREIGN KEY (id_anotacao)
        REFERENCES anotacao_clinica(id_anotacao);
);

CREATE TABLE IF NOT EXISTS anotacao_clinica (
    id_anotacao INTEGER PRIMARY KEY,
    id_profissional INTEGER,
    data_hora TIMESTAMP,
    texto_evolucao VARCHAR(300),
    hipotese_diagnostica VARCHAR(100),

    CONSTRAINT FK_ANOTACAO_CLINICA_id_profissional
        FOREIGN KEY (id_profissional)
        REFERENCES profissional(id_profissional);
);