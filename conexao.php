<?php

// HOST localhost, IP, domínio
// Base de Dados

try {
  /* $drive = 'mysql:host=51.79.72.47;dbname=onnyc613_sandbox;charset=utf8';
  $usuario = 'onnyc613_aluno';
  $senha = 'Senha4lun0.@'; */

  $drive = 'mysql:host=localhost;dbname=adotapetva;charset=utf8';
  $usuario = 'root';
  $senha = '';

  $conexao = new PDO($drive, $usuario, $senha);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

} catch (\Exception $err) {
  echo 'Erro ao Conectar no Banco de Dados. Message:' . $err->getMessage();
  die;
}