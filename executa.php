<?php

require('conexao.php');
require('cabecalho.php');

// query() - Executa um comando SQL
// prepare
// execute

# Responsáveis, Endereços, Ongs

# Inserir um Novo Endereço

# Criar as outras tabelas


/* 

Inserir dado na tabela

INSERT INTO nome_tabela (colunas) VALUES (valores)

$sql = "INSERT INTO enderecos VALUES ('CE', '63540000', 'Várzea Alegre', 'Doutor Pedro2', '150', 'Alto')";

$conexao->query($sql);
*/

# Recuperando os dados de uma tabela



/* $sql = "SELECT count(*) as total FROM enderecos";

$buscaEnderecos = $conexao->prepare($sql);
$buscaEnderecos->execute();
$resultados =$buscaEnderecos->fetchAll(); // Array

foreach($resultados as $linha) {
  echo "<pre>";
  print_r($linha);
  echo "</pre><br>";
} */


$sql = "DELETE FROM enderecos WHERE bairro = 'Alto do Tenente'";
$conexao->query($sql);
?>