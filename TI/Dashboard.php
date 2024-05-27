<?php
//inicia ou resume uma sessão PHP
  session_start();
  $hashedPassword = $_SESSION['password'];
  //verifica se a variável de sessão 'username' não está definida, o operador !isset retorna verdadeiro se a variável de sessão
  if (!isset($_SESSION['username'])) {
    //envia um cabeçalho HTTP para redirecionar o usuário para a página 'index.php' após 5 segundos.
    header("refresh:5;url=index.php");
    //
    die("Acesso Restrito.");
  }

  $username = $_SESSION['username'];

//recebe e guarda os valores respetivos dos ficheiros
$valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
$valor_log = file_get_contents("api/files/temperatura/log.txt");
$valor_hora = file_get_contents("api/files/temperatura/hora.txt");
$nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");

//recebe e guarda os valores respetivos dos ficheiros
$valor_humidade = file_get_contents("api/files/humidade/valor.txt");
$valor_log_humidade = file_get_contents("api/files/humidade/log.txt");
$valor_hora_humidade = file_get_contents("api/files/humidade/hora.txt");
$nome_humidade = file_get_contents("api/files/humidade/nome.txt");

//recebe e guarda os valores respetivos dos ficheiros
$valor_led = file_get_contents("api/files/arduino/estado.txt");
$valor_log_led = file_get_contents("api/files/arduino/log.txt");
$valor_hora_led = file_get_contents("api/files/arduino/hora.txt");
$nome_led = file_get_contents("api/files/arduino/nome.txt");


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Plataforma IoT</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="Dashboard.php">Dashboard EI-TI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="historico.php">Histórico</a>
            </li>
          </ul>
        </div>
        <button class="btn btn-outline-danger" type="button" onclick="window.location.href='logout.php'">Logout</button>
      </div>
    </nav>
    <div class="container d-flex justify-content-around align-items-center">
      <div id="title-header">
        <h1>Servidor IoT</h1>
        <h6>user: <?php echo ($_SESSION['username']) ?></h6>
      </div>
      <img
        src="imagens/estg.png"
        alt="Imagem ESTG"
        style="width: 300px"
      />
    </div>

    <hr>
    <br>

    <div class="container ">
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="sensor card-header text-center">
                        <?php
                        // Valor da temperatura recebido dinamicamente
                        echo $nome_temperatura.": ".$valor_temperatura;
                        ?>ºC
                    </div>
                    <div class="card-body">
                        <img src="imagens/temperature-high.png" alt="temperatura" style="width: 100px;">
                    </div>
                    <div class="card-footer">
                        <p class><b>Atualização: </b><?php
                        echo $valor_hora; 
                        ?> -
                        <a href="#">Ver Histórico</a></p>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="sensor card-header text-center">
                        Humidade 70%
                    </div>
                    <div class="card-body">
                        <img src="imagens/humidity-high.png" alt="temperatura" style="width: 100px">
                    </div>
                    <div class="card-footer">
                        <p><b>Atualização:</b> 2024/03/10 14:31 -
                        <a href="#">Ver Histórico</a></p>
                </div>
                </div>
            </div>
            <div class="col-sm-4 mb-4">
                <div class="card">
                    <div class="atuador card-header text-center">
                        Led Arduino: Ligado
                    </div>
                    <div class="card-body">
                        <img src="imagens/light-on.png" alt="temperatura" style="width: 100px">
                    </div>
                    <div class="card-footer">
                        <p><b>Atualização:</b> 2024/03/10 14:31 -
                        <a href="#">Ver Histórico</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header text-start">
              <strong>Tabela de Sensores</strong>
            </div>
            <div class="card-body">
              <table class="table">
                <thead scope="row">
                  <tr>
                    <th scope="col">Tipo de Dispositivos IoT</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data de Atualização</th>
                    <th scope="col">Estado de Alertas</th>
                  </tr>
                </thead>
                <tbody >
                    <tr >
                    <td ><?php echo $nome_temperatura; ?></td>
                    <td><?php echo $valor_temperatura; ?>ºC</td>
                    <td><?php echo $valor_hora; ?></td>
                    <td><span class="badge rounded-pill text-bg-danger">Elevado</span>
                    </td>
                    </tr>
                    <tr >
                    <td >Humidade</td>
                    <td>70%</td>
                    <td>30</td>
                    <td><span class="badge rounded-pill text-bg-primary">Normal</span>
                    </td>
                    </tr>
                    <tr >
                    <td >Led Arduino</td>
                    <td>Ligado</td>
                    <td>35</td>
                    <td><span class="badge rounded-pill text-bg-success">Ativo</span>
                    </tr>

                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>