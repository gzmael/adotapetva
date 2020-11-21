/* Criar as tabelas */
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
  email_responsavel VARCHAR(150) NOT NULL UNIQUE KEY,
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
email_ong VARCHAR(150) UNIQUE,
cnpj_cpf VARCHAR(15) UNIQUE,
telefone_ong VARCHAR(15),
logo VARCHAR(45),
nome_resp VARCHAR(100),
email_resp VARCHAR(45),
id_enderecos INT,

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
vacinas TINYINT(1),
castrado TINYINT(1),
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

/* Inserindo as Ongs */

INSERT INTO enderecos VALUES 
(1, 'CE', 'Várzea Alegre', '63540000', 'Rua Iraildes', '1234', 'Alto do Tenente', null);

INSERT INTO ongs VALUES 
(1, 'Pets Felizes', 'felizes@gmail.com', '123156189123612', '88993202026', null, 'Jezmael', 'jezmael@gmail.com', 1);

INSERT INTO enderecos VALUES 
(2, 'CE', 'Várzea Alegre', '63540000', 'Rua Rebouças', '45', 'Betânia', null);

INSERT INTO ongs VALUES 
(2, 'Pets Fofinhos', 'fofinhos@gmail.com', '123156189123625', '88993202026', null, 'Bruno', 'bruno@gmail.com', 2);

INSERT INTO enderecos VALUES 
(3, 'CE', 'Várzea Alegre', '63540000', 'Centro', '450', 'Avenida Dom Lino', 'APT 2');

INSERT INTO ongs VALUES 
(3, 'Pet Amáveis', 'pets@amaveis.com', '123276189123625', '88993202026', 'logo.png', 'Bruno', 'bruno@gmail.com', 3);

/* Inserindo os Responsaveis */

INSERT INTO enderecos VALUES 
(4, 'CE', 'Várzea Alegre', '63540000', 'Centro', '16', 'Rua Iraildes Ferreira', null);

INSERT INTO responsaveis VALUES
(1, 'Jezmael Basilio', '123.456.789-25', 'jezmael@gmail.com', 'qwe123', '88993200970', 4);

INSERT INTO enderecos VALUES 
(5, 'CE', 'Várzea Alegre', '63540000', 'Juremal', '10', 'Zeca Oliveira', null);

INSERT INTO responsaveis VALUES
(2, 'Thalia', '123.459.789-55', 'thalia@gmail.com', 'qwe123', '88993200970', 5);

INSERT INTO enderecos VALUES 
(6, 'CE', 'Várzea Alegre', '63540000', 'Senharol', NULL, 'Rua Sitio Zezinho', null);

INSERT INTO responsaveis VALUES
(3, 'Neuma', '166.459.789-55', 'neuma@gmail.com', 'qwe123', '88999995648', 6);

INSERT INTO enderecos VALUES 
(7, 'CE', 'Várzea Alegre', '63540000', 'Canidezinho', '6', 'Sitio Antonio', null);

INSERT INTO responsaveis VALUES
(4, 'Carlos', '789.123.456-89', 'carlos@gmail.com', 'qwe123', '95888885648', 7);

/* Inserir PETs */

INSERT INTO pets (id_pets, nome_pet, bio, chamada, tipo, sexo, raca, data_nascimento, vacinas, castrado, id_ongs) VALUES (1, 'Chumbinho', 'O mais novo de 9 irmãos que nasceram...', 'Sou gordinho e fofinho mas consigo correr atrás da bola', 'cachorro', 'm', 'vira-lata', '2020-11-11', 1, 1, 2),
(2, 'Fofura', 'Veio da ninhada mais linda', 'Como assim não vai me levar?', 'gato', 'f', 'parda', '2020-01-11', 1, 0, 1),
(3, 'Titela', 'Foi achado abandonado no sítio do seu zé', 'Posso lhe esperar enquanto está no trabalho...', 'cachorro', 'm', 'pinche', '2020-01-20', 0, 0, 3),
(4, 'Chocalho', 'bio...', 'Gosto de falar só o necessário...', 'papagaio', 'f', 'zaul', '2020-06-05', 1, 1, 1),
(5, 'Pretinha', 'bio...', 'Meu amor é tão grande e cheio de fome', 'cachorro', 'f', 'vira-lata', '2020-01-01', 1, 1, 2),
(6, 'Doçurinha', 'bio...', 'Não sou violenta, só tenho ciúmes', 'cachorro', 'f', 'pinche', '2020-01-25', 1, 1, 1),
(7, 'Caramelho', 'bio...', 'Com muito carinho eu saberei lhe defender', 'cachorro', 'm', 'vira-lata', '2020-01-25', 1, 1, 2);

/* Inserir as Adoções */

INSERT INTO adocoes (id_responsavel, id_pets, data_adocao) VALUES
(1, 2, '2020-11-20 20:20:00'),
(3, 3, '2020-11-20 20:20:00'),
(3, 1, '2020-11-20 20:20:00'),
(2, 7, '2020-11-20 20:20:00');