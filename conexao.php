<?php

// HOST localhost, IP, domínio
// Base de Dados

try {
$drive = 'mysql:host=localhost;dbname=adotapet;charset=utf8';
$usuario = 'root';
$senha = '';

$conexao_mysql = new PDO($drive, $usuario, $senha);

} catch (\Exception $e) {
  echo 'Erro ao Conectar no Banco de Dados. Message:' . $ex->getMessage();
  die;
}