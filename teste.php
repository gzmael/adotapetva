<?php

require('conexao.php');

if(isset($_POST['new'])) {
  $query = filter_input(INPUT_POST, 'query');

  if(empty($query)) {
    $msg = 'Não foi enviado nada na Query';
  }else{
    try {
      $comando = $conexao->prepare($query);
      $comando->execute();
      //code...
    } catch (PDOException $err) {
      //throw $th;
      $msg = 'Erro ao cadastrar';
      print_r($err);
    }
  }
}

$tableList = $conexao->query('SHOW TABLES');
$allTables = $tableList->fetchAll();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teste de SQL</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;900&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-green-1: #B1E9DE;
      --bg-green-2: #9ddfd3;
      --bg-green-3: #8CCABF;
      --bg-salmon-1: #FFE9E9;
      --bg-salmon-2: #ffdada;
      --bg-salmon-3: #CCADAD;
      --bg-yellow-1: #EAFBF3;
      --bg-yellow-2: #dbf6e9;
      --bg-yellow-3: #AEC6BA;
      --bg-blue-1: #5D5E92;
      --bg-blue-2: #31326f;
      --bg-blue-3: #26265B;
    }
    * {
      outline: none;
      text-decoration: none;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Roboto', sans-serif;
      background: var(--bg-yellow-2);
      
      display:flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    main {
      width: 100vw;
      height: 100vh;
      display:flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;

      min-width: 320px;
      width: calc((100vw/3)*2);
      max-width: 800px;
    }

    h1 {
      color: var(--bg-blue-2);
      margin-bottom: 8px;
    }

    form {
      display:flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      width: 100%;
    }

    form textarea{
      border: 2px solid #ccc;
      border-radius: 4px;
      max-height: 400px;
      padding: 8px;
      font-family: 'Roboto', sans-serif;
      resize: none;
      box-shadow: 0 3px 0 rgba(0,0,0,.05);
      color: #010101;
      width: 100%;
    }

    hr {
      padding:8px 0;
      border: none;
      border-bottom: 2px solid var(--bg-yellow-3);
      width: 100%;
    }

    form button {
      margin-top: 12px;
      background: var(--bg-green-2);
      color: #fff;
      font-weight: 900;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      cursor: pointer;
      box-shadow: 0 3px 0 rgba(0,0,0,.05);
      transition: background ease 0.2s
    }

    form button:hover {
      background: var(--bg-green-3);
    }

    aside {
      width: 100%;
      margin: 12px 0;
    }

    ul {
      list-style: none;
      width: 100%;

      display: grid;
      grid-gap: 20px;
      grid-template-columns: 1fr 1fr;
    }

    ul li {
      background: var(--bg-yellow-1);
      border-radius: 4px;
      padding: 6px;
    }

    h4 {
      text-align: center;
      margin: 8px 0;
      color: var(--bg-blue-2)
    }

    table {
      font-size: 12px;
      border-collapse: collapse;
      width: 100%;
      border: 1px solid gray;
    }

    table thead {
      background: var(--bg-green-2);
    }

    table td, table th {
      padding: 2px;
    }
    table td {
      background: var(--bg-salmon-1)
    }
    table tbody tr:nth-child(2n) td{
      background: var(--bg-salmon-2)
    }
  </style>
</head>
<body>
  <main>
    <h1>Teste de Queries SQL</h1>
    <form action="" method="POST">
      <textarea name="query" id="" cols="30" rows="10" placeholder="Insira sua Query"></textarea>
      <button type="submit" name="new">Enviar</button>
    </form>
    <?php if(isset($msg)) echo '<h3>'.$msg.'</h3>'; ?>
    <hr>
    <aside>
    <h3><?=count($allTables)?> tabelas cadastradas</h3>
      <ul>
        <?php
        foreach($allTables as $table){
        ?>
        <li>
          <h4><?=$table[0]?></h4>
          <table>
            <thead>
              <tr>
                <th>Campo</th>
                <th>Tipo</th>
                <th>Nulo?</th>
                <th>Chave</th>
                <th>Extra</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $dadosTabela = $conexao->prepare("SHOW COLUMNS FROM ". $table[0]);
              $dadosTabela->execute();
              while($res = $dadosTabela->fetchObject()){
            ?>
              <tr>
                <td><?=$res->Field?></td>
                <td><?=$res->Type?></td>
                <td><?=$res->Null?></td>
                <td><?=$res->Key?></td>
                <td><?=$res->Extra?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </li>
        <?php } ?>
      </ul>
    </aside>
  </main>
</body>
</html>