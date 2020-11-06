-- Comando SQL (Query)

-- Conectar a um BD

-- Criar uma base de dados

CREATE DATABASE nomedatabase;

-- Usar uma base da Dados
USE nomedatabase;

-- Criar uma tabela

CREATE TABLE enderecos (
  id_enderecos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uf VARCHAR(2) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  cep VARCHAR(9) NOT NULL,
  logradouro VARCHAR(100) NOT NULL,
  numero VARCHAR(5),
  bairro VARCHAR(45),
  complemento VARCHAR(45)
);

CREATE TABLE responsaveis (
  id_responsaveis INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome_responsavel VARCHAR(100) NOT NULL,
  cpf VARCHAR(14) NOT NULL UNIQUE KEY,
  email_responsavel VARCHAR(14) NOT NULL UNIQUE KEY,
  senha VARCHAR(45) NOT NULL,
  tel_responsavel VARCHAR(16) NOT NULL,
  id_enderecos INT,
  
  CONSTRAINT fk_responsaveis_enderecos
  FOREIGN KEY (id_enderecos) REFERENCES enderecos(id_enderecos) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Mostrar as tabelas
SHOW TABLES;

-- Alterar uma tabela

-- Deletar uma tabela
DROP TABLE enderecos;

-- Adicionar Coluna
-- Alterar uma Coluna
-- Remover uma Coluna