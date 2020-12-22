<?php

// HOST localhost, IP, domínio
// Base de Dados

try {

  $param1 = 'mysql:host=localhost;dbname=adotapetva;charset=utf8';
  $param2 = 'root';
  $param3 = '';

  $conexao = new PDO($param1, $param2, $param3);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch (\Exception $err) {
  echo 'Erro ao Conectar no Banco de Dados. Message:' . $err->getMessage();
  die;
}
