<?php
require('conexao.php');
require('cabecalho.php');
?>

  <title>Adota VA | Entrar</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  
<div id="wrapper">

  <div class="container">
  <?php require('menu_topo.php'); ?>

  <div id="content">
    <div class="form_content">
      <h3>Fazer Login</h3>
      <form action="" method="post">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Senha">
        <button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
      </form>
      <a href="cadastro.php">Não tenho conta</a>
    </div>
    <img src="img/singup.png" alt="Homem segurando cachorro">
  </div>
  </div>
</div>

</body>
</html>