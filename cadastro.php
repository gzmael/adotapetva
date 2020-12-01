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

  // Tenta encontrar um responsável com os mesmo dados
  $sqlConsulta = "SELECT * FROM responsaveis WHERE cpf = ? OR email_responsavel = ? OR tel_responsavel = ?";

  $consultaResponsavel = $conexao->prepare($sqlConsulta);

  $dadosConsulta = [
    $cpf,
    $email,
    $telefone
  ];

  $consultaResponsavel->execute($dadosConsulta);
  $seExiste = $consultaResponsavel->rowCount() > 0 ? true : false;

  // 1. Validar os dados
  if(empty($nome)) {
    $erro = 'O campo de nome deve ser preenchido.';
  }elseif($seExiste){
    $erro = 'Já existe um usuário com esses dados';
  }elseif(empty($cpf)){
    $erro = 'O campo do CPF deve ser preenchido.';
  }elseif(empty($telefone)){
    $erro = 'O campo de Telefone deve ser preenchido.';
  }elseif(empty($email)){
    $erro = 'O campo de E-mail deve ser válido.';
  }elseif(empty($senha) || ($confirma_senha !== $senha)){
    $erro = 'Os campos de Senha e Confirmação de senha devem estar corretos.';
  }else {

    try{

      // 2. Preparar a Query
      $sql = "INSERT INTO responsaveis (nome_responsavel, cpf, email_responsavel, senha, tel_responsavel) VALUES (:nome, :cpf, :email, :senha, :telefone)";

      $option = [
        'cost' => 8
      ];

      $hash = password_hash($senha, PASSWORD_BCRYPT, $option);

      $data = [
        'nome' => $nome,
        'cpf' => $cpf,
        'email' => $email,
        'senha' => $hash,
        'telefone' => $telefone
      ];

      $insereReponsavel = $conexao->prepare($sql);
      
      // 3. Executar a Query com os dados
      $insereReponsavel->execute($data);

      $ok = true;

      // 4. Testar se foi cadastrado com sucesso
    } catch (PDOException $e) {
      $erro = $e->getMessage();
    }

  }
  

}
?>
  <title>Adota VA | Cadastro</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  
<div id="wrapper">

  <div class="container">
  <?php require('menu_topo.php'); ?>

  <div id="content">
    <div class="form_content">
      <h3>Cadastro</h3>

      <?php if(isset($erro)) { ?>
        <div class="alert error">
          <strong>Erro:</strong>
          <?=$erro?>
        </div>
      <?php } ?>

      <?php if(isset($ok)) { ?>
        <div class="alert success">
          <strong>Reponsável cadastrado com sucesso!</strong>
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
      <a href="cadastro_ong.php" class="text-green">Faço parte de uma ONG</a>
    </div>
    <img src="img/singup.svg" alt="Homem segurando cachorro">
  </div>
  </div>
</div>

</body>
</html>