<?php

// HOST localhost, IP, domínio
// Base de Dados

try {
  $drive = 'mysql:host=51.79.72.47;dbname=onnyc613_sandbox;charset=utf8';
  $usuario = 'onnyc613_aluno';
  $senha = 'Senha4lun0.@';

  $conexao = new PDO($drive, $usuario, $senha);

} catch (\Exception $err) {
  echo 'Erro ao Conectar no Banco de Dados. Message:' . $err->getMessage();
  die;
}
echo phpinfo();