# 🚆 Gestão Ferroviária - Banco de Dados

Um banco de dados simples e funcional para um sistema de **gestão ferroviária**. Inclui controle de usuários, trens, alertas de manutenção e rotas.

---

## 🧭 Visão Geral

Este projeto cria o banco **`gestao_ferroviaria_db`**, com estrutura pronta para uso em sistemas de controle de trens e operações.

Tabelas principais:

* 👤 **usuarios** → login e cargo (adm ou func)
* 🚆 **trens** → lista de trens e status
* ⚠️ **alertas_manutencao** → problemas registrados
* 🗺️ **rotas** → trajeto e horários

---

## ⚙️ Como Usar

1. Abra seu gerenciador **MySQL** (phpMyAdmin, DBeaver ou terminal).
2. Copie e cole o código abaixo.
3. Execute para criar o banco e os dados de exemplo.

---

## 💾 Script SQL Completo

```sql
CREATE DATABASE IF NOT EXISTS gestao_ferroviaria_db
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE gestao_ferroviaria_db;

DROP TABLE IF EXISTS rotas;
DROP TABLE IF EXISTS alertas_manutencao;
DROP TABLE IF EXISTS trens;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  cargo ENUM('adm','func') DEFAULT 'func',
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE trens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  status ENUM('em_operacao','em_manutencao','parado') DEFAULT 'parado',
  capacidade INT DEFAULT 0,
  data_aquisicao DATE
);

CREATE TABLE alertas_manutencao (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_trem INT NOT NULL,
  descricao TEXT NOT NULL,
  severidade ENUM('baixa','media','alta') DEFAULT 'baixa',
  status ENUM('aberto','fechado') DEFAULT 'aberto',
  data_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_fechamento TIMESTAMP NULL,
  FOREIGN KEY (id_trem) REFERENCES trens(id) ON DELETE CASCADE
);

CREATE TABLE rotas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(150) NOT NULL,
  estacao_partida VARCHAR(100) NOT NULL,
  estacao_chegada VARCHAR(100) NOT NULL,
  horario_partida DATETIME NOT NULL,
  horario_chegada_previsto DATETIME NOT NULL,
  id_trem_designado INT NOT NULL,
  FOREIGN KEY (id_trem_designado) REFERENCES trens(id)
);

INSERT INTO usuarios (nome, email, senha, cargo) VALUES
  ('Admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'adm'),
  ('Operador', 'user@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'func');

INSERT INTO trens (nome, status, capacidade, data_aquisicao) VALUES
  ('Trem Alfa', 'em_operacao', 300, '2023-01-15'),
  ('Expresso 102', 'em_operacao', 500, '2022-05-20'),
  ('Cargueiro 03A', 'parado', 0, '2020-11-10'),
  ('Regional V01', 'em_manutencao', 150, '2021-03-05'),
  ('Expresso 103', 'em_operacao', 500, '2022-05-20');

INSERT INTO alertas_manutencao (id_trem, descricao, severidade, status, data_abertura, data_fechamento) VALUES
  (4, 'Falha no sistema de freios.', 'alta', 'aberto', CURRENT_TIMESTAMP, NULL),
  (1, 'Desgaste nas rodas.', 'media', 'aberto', CURRENT_TIMESTAMP, NULL),
  (2, 'Ar condicionado inoperante.', 'baixa', 'fechado', '2025-10-25 10:00:00', '2025-10-25 12:15:00');

INSERT INTO rotas (nome, estacao_partida, estacao_chegada, horario_partida, horario_chegada_previsto, id_trem_designado) VALUES
  ('Rota Expressa 101', 'Estação Central', 'Estação Norte', DATE_ADD(NOW(), INTERVAL 2 HOUR), DATE_ADD(NOW(), INTERVAL 4 HOUR), 1),
  ('Linha Metrô 02', 'Estação Sul', 'Estação Leste', DATE_ADD(NOW(), INTERVAL 3 HOUR), DATE_ADD(NOW(), INTERVAL 4 HOUR), 2),
  ('Rota Suburbana 55', 'Estação Central', 'Estação Oeste', DATE_ADD(NOW(), INTERVAL 5 HOUR), DATE_ADD(NOW(), INTERVAL 7 HOUR), 5);
```

---

## 🧪 Teste Rápido

```sql
SELECT * FROM usuarios;
SELECT * FROM trens;
SELECT * FROM alertas_manutencao;
SELECT * FROM rotas;
```

---

## 💡 Dicas

* As senhas são apenas exemplos (hash do texto `password`).
* Altere os e-mails e senhas conforme seu ambiente.
* Crie os trens antes dos alertas e rotas, para não quebrar os vínculos.