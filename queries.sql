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

  FOREIGN KEY (id_enderecos) REFERENCES enderecos(id_enderecos) 
  ON DELETE SET NULL 
  ON UPDATE CASCADE
);

CREATE TABLE ongs (
id_ongs INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome_ong VARCHAR(100) UNIQUE,
email_ong VARCHAR(45) UNIQUE,
cnpj_cpf VARCHAR(15) UNIQUE,
telefone_ong VARCHAR(15),
logo VARCHAR(45),
nome_resp VARCHAR(100),
email_resp VARCHAR(45),
id_enderecos INT(),

CONSTRAINT fk_ongs_enderecos
FOREIGN KEY (id_enderecos) REFERENCES enderecos(id_enderecos) 
 ON DELETE SET NULL 
 ON UPDATE CASCADE
);

CREATE TABLE pets (
id_pets INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome_pet VARCHAR(45),
bio TEXT,
chamada VARCHAR(150),
foto VARCHAR(65),
tipo VARCHAR(10) NOT NULL,
sexo VARCHAR(1) NOT NULL,
raca VARCHAR(45) NOT NULL,
data_nascimento DATE,
vascinas TINYINT(1),
castrato TINYINT(1),
diagnostico TINYINT(1),
cadastrado_em DATETIME DEFAULT NOW(),
atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
id_ongs INT,

CONSTRAINT fk_pets_ongs
FOREIGN KEY (id_ongs) REFERENCES ongs(id_ongs) 
 ON DELETE CASCADE 
 ON UPDATE CASCADE
);


CREATE TABLE adocoes (
id_adocoes INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_responsavel INT,
id_pets INT,
data_adocao DATETIME,
cadastrado_em DATETIME DEFAULT NOW(),
atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_adocoes_pets
FOREIGN KEY (id_pets) REFERENCES pets(id_pets) 
 ON DELETE CASCADE 
 ON UPDATE CASCADE,

CONSTRAINT fk_adocoes_responsaveis
FOREIGN KEY (id_responsavel) REFERENCES responsaveis(id_responsaveis) 
 ON DELETE CASCADE 
 ON UPDATE CASCADE
);
-- Mostrar as tabelas
SHOW TABLES;

-- Renomear uma tabela

RENAME TABLE tabela_atual TO nova_tabela
ALTER TABLE tabela_atual RENAME TO tabela_nova

-- Adicionar nova coluna

ALTER TABLE end 
ADD COLUMN nova INT NOT NULL

-- Remover uma coluna
ALTER TABLE end
DROP nova

-- Deletar uma tabela
DROP TABLE tabela
