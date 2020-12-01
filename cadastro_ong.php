<?php
require('conexao.php');
require('cabecalho.php');

/* Código de Cadastro de Responsável */
if(isset($_POST['entrar'])){

  $nome = filter_input(INPUT_POST, 'nome');
  $cpf = filter_input(INPUT_POST, 'cpf');
  $telefone = filter_input(INPUT_POST, 'telefone');
  $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $senha = filter_input(INPUT_POST, 'senha');
  $confirma_senha = filter_input(INPUT_POST, 'confirma_senha');

  /* Verificar se existe algum responsável já cadastrado */

  $queryConsulta = "SELECT id_responsaveis FROM responsaveis WHERE email_responsavel = :email OR cpf = :cpf OR tel_responsavel = :telefone";

  $dadosConsulta = [
    ':email' => $email,
    ':cpf' => $cpf,
    ':telefone' => $telefone
  ];

  $estaCadastrado = $conexao->prepare($queryConsulta);
  $estaCadastrado->execute($dadosConsulta);

  $responsavel = $estaCadastrado->fetchObject();

  if(!empty($responsavel)){
    $erro = 'Já existe um usuário cadastrado com esses dados.';
  }elseif(empty($nome)) {
    $erro = 'O campo de Nome está vazio.';
  }elseif(empty($email)){
    $erro = 'O campo de E-mail está inválido.';
  }elseif(empty($cpf)){
    $erro = 'O campo de CPF está vazio.';
  }elseif(empty($telefone)){
    $erro = 'O campo de Telefone está vazio.';
  }elseif(empty($senha)){
    $erro = 'O campo de Senha está vazio.';
  }elseif($senha !== $confirma_senha){
    $erro = 'As senhas não são iguais.';
  }else {

    /* Criptografando Senha */
    $opcaoHash = [
      'cost' => 8
    ];
    $hash_senha = password_hash($senha, PASSWORD_BCRYPT, $opcaoHash);

    /* Adiciona os dados no BD */
    try {
      $sql = "INSERT INTO responsaveis (nome_responsavel, email_responsavel,cpf, tel_responsavel, senha) VALUES (:nome, :email, :cpf, :telefone, :senha)";

      $insereResponsavel = $conexao->prepare($sql);

      $dados = array(
        ':nome' => $nome,
        ':email' => $email,
        ':cpf' => $cpf,
        ':telefone' => $telefone,
        ':senha' => $hash_senha
      );

      $insereResponsavel->execute($dados);

      $ok = true;

    } catch (PDOException $e) {
      $erro = $e->getMessage();
    }
  }

}
?>
  <title>Adota VA | Cadastro ONG</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  
<div id="wrapper">

  <div class="container">
  <?php require('menu_topo.php'); ?>

  <div id="content">
    <div class="form_content">
      <h3>Cadastro de ONG</h3>

      <?php if(isset($erro)) { ?>
        <div class="alert error">
          <strong>Erro:</strong>
          <?=$erro?>
        </div>
      <?php } ?>

      <form action="" method="post">
        <input type="text" name="nome" placeholder="Nome">
        <input type="text" name="cpf" placeholder="CPF">
        <input type="text" name="telefone" placeholder="Telefone">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="senha" placeholder="Senha">
        <input type="password" name="confirma_senha" placeholder="Confirme a Senha">
        <button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
      </form>
      <a href="login.php">Já tenho conta</a>
      <a href="cadastro.php" class="text-green">Quero adotar</a>
    </div>
    <img src="img/ong.svg" alt="Homem segurando cachorro">
  </div>
  </div>
</div>

</body>
</html>