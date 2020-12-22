<?php
require('conexao.php');
require('cabecalho.php');

?>

  <title>Adota PET VA | Busca</title>
  <link rel="stylesheet" href="css/busca.css">
</head>
<body>
  
<div id="wrapper">

  <div class="container">
  <?php require('menu_topo.php'); ?>

  <div id="content">
    <?php

if(isset($_GET['busca'])) {
  $tipo = filter_input(INPUT_GET, 'tipo');
  $sexo = filter_input(INPUT_GET, 'sexo');
  $idade = filter_input(INPUT_GET, 'idade');
  $castrado = filter_input(INPUT_GET, 'castrado');

  $sqlBusca = "SELECT * FROM pets";
  $filtros = [];

  if($tipo) {
    $filtros[] = "tipo = :tipo";
  }
  
  if($sexo) {
    $filtros[] = "sexo = :sexo";
  }
  
  if($castrado) {
    $filtros[] = "castrado = 1";
  }
  
  $filtrosSQL = implode(" AND ", $filtros);
  // vai ficar assim
  // SELECT * FROM pets WHERE tipo = ? AND sexo = ? AND castrado = 1

  if(!empty($filtros)) 
    $sqlBusca .= " WHERE $filtrosSQL";

  $pegaTodosOsPETs = $conexao->prepare($sqlBusca);

  // trata as variáveis para as entradas no prepare
  if($tipo) {
    $pegaTodosOsPETs->bindParam(':tipo', $tipo, PDO::PARAM_STR, 8);
  }

  if($sexo) {
    $pegaTodosOsPETs->bindParam(':sexo', $sexo, PDO::PARAM_STR, 1);
  }

  $pegaTodosOsPETs->execute();
  $todososPets = $pegaTodosOsPETs->fetchAll();
  $total = $pegaTodosOsPETs->rowCount();

}else{
  $pegaTodosOsPETs = $conexao->query("SELECT * FROM pets");
  $todososPets = $pegaTodosOsPETs->fetchAll();
  $total = $pegaTodosOsPETs->rowCount();
}

    ?>
    <form action="" method="get">

      <select name="tipo" id="tipo">
        <option value="">Tipo</option>
        <option value="cachorro" <?=$_GET['tipo'] === 'cachorro' ? 'selected': ''?>>Cachorro</option>
        <option value="gato" <?=$_GET['tipo'] === 'gato' ? 'selected': ''?>>Gato</option>
        <option value="ave" <?=$_GET['tipo'] === 'ave' ? 'selected': ''?>>Ave</option>
      </select>

      <select name="sexo" id="sexo">
        <option value="">Sexo</option>
        <option value="m" <?=$_GET['sexo'] === 'm' ? 'selected': ''?>>Macho</option>
        <option value="f" <?=$_GET['sexo'] === 'f' ? 'selected': ''?>>Fêmea</option>
      </select>

      <select name="idade" id="idade">
        <option value="">Idade</option>
        <option value="filhote">Filhote (< 6 meses)</option>
        <option value="adolecentes">Adolescente (entre 6 e 24 meses)</option>
        <option value="adulto">Adulto (> 24 meses)</option>
      </select>

      <select name="castrado" id="castrado">
        <option value="">Não Castrado</option>
        <option value="1" <?=$_GET['castrado'] ? 'selected': ''?>>Castrado</option>
      </select>

      <button type="submit" name="busca" class="btn btn-primary">Filtrar</button>
    </form>

    <h3><?=$total?> Pets disponíveis para adoção</h3>
    
    <ul class="lista-pets">
      <?php

        foreach($todososPets as $pet) {
      ?>
      <li class="pet">
        <?php 
        $foto = ($pet->foto) ? $pet->foto : 'gato-1.png';
        ?>
        <img src="uploads/<?=$foto?>" alt="Gato" class="img-pet">
        <div class="descricao">
          <header>
            <h4><?=$pet->nome_pet?></h4>
            <a href="#">s2</a>
          </header>
          <p><?=$pet->chamada?></p>
          <span class="raca"><?=$pet->raca?></span>
          <ul class="extras">
            <li class="tipo">icone</li>
            <li class="sexo">icone</li>
            <li class="castrado">icone</li>
            <li class="vermifungo">icone</li>
            <li class="vacina">icone</li>
          </ul>
        </div>
      </li>
      <?php
        }
      ?>

    </ul>

  </div>
  </div>
</div>

</body>
</html>