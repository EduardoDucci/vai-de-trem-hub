CREATE DATABASE ferrovia_db;
USE ferrovia_db;


CREATE TABLE estacao (
    id_estacao INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cidade VARCHAR(100),
    estado VARCHAR(50)
);


CREATE TABLE trem (
    id_trem INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,
    capacidade_passageiros INT NOT NULL,
    ano_fabricacao YEAR,
    status ENUM('operacional', 'manutenção', 'fora de serviço') DEFAULT 'operacional'
);


CREATE TABLE funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cargo ENUM('maquinista', 'manutenção', 'atendente', 'administrativo') NOT NULL,
    telefone VARCHAR(20),
    cpf VARCHAR(14) UNIQUE NOT NULL
);


CREATE TABLE rota (
    id_rota INT AUTO_INCREMENT PRIMARY KEY,
    estacao_origem_id INT NOT NULL,
    estacao_destino_id INT NOT NULL,
    distancia_km DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (estacao_origem_id) REFERENCES estacao(id_estacao),
    FOREIGN KEY (estacao_destino_id) REFERENCES estacao(id_estacao)
);


CREATE TABLE viagem (
    id_viagem INT AUTO_INCREMENT PRIMARY KEY,
    id_trem INT NOT NULL,
    id_rota INT NOT NULL,
    data_partida DATETIME NOT NULL,
    data_chegada DATETIME NOT NULL,
    id_maquinista INT,
    FOREIGN KEY (id_trem) REFERENCES trem(id_trem),
    FOREIGN KEY (id_rota) REFERENCES rota(id_rota),
    FOREIGN KEY (id_maquinista) REFERENCES funcionario(id_funcionario)
);


CREATE TABLE bilhete (
    id_bilhete INT AUTO_INCREMENT PRIMARY KEY,
    id_viagem INT NOT NULL,
    nome_passageiro VARCHAR(100) NOT NULL,
    documento VARCHAR(20),
    assento VARCHAR(10),
    data_compra DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_viagem) REFERENCES viagem(id_viagem)
);


CREATE TABLE usuarios (
	id_usuarios INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cargo ENUM('adm','func') NOT NULL
);

INSERT INTO usuarios (usuario, senha) VALUES ('caio','123');