<?php
//inicia ou resume uma sessão PHP
session_start();
//verifica se a variável de sessão 'username' não está definida, o operador !isset retorna verdadeiro se a variável de sessão
if (!isset($_SESSION['username'])) {
  //envia um cabeçalho HTTP para redirecionar o usuário para a página 'index.php' após 5 segundos.
  header("refresh:5;url=index.php");

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
<meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Histórico</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">Dashboard EI-TI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="Dashboard.php">Home</a>
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

    <div class="col-sm-12 d-flex justify-content-center">
        <div class="card">
            <div class="card-header text-start">
                <strong>Historico de Sensores</strong>
            </div>
            <div class="card-body ">
        <table class="table row ">
        <thead>
            <tr>
            <th scope="col">Tipo de Dispositivos IoT</th>
            <th scope="col">Valor</th>
            <th scope="col">Data de Atualização</th>
            <th scope="col">Estado de Alertas</th>
            </tr>
        </thead>
        <tbody>
            <!--Alterar para quando selecionar data os valores aparecerem corretamente -->
            <tr>
            <td ><?php echo $nome_temperatura; ?></td>
            <td>
                <select class="form-select" aria-label="Estado de Alertas">
                    <option selected><?php echo $valor_temperatura; ?> ºC</option>
                    <?php
                    $log_values = explode("\n", $valor_log);
                    foreach ($log_values as $log_value) {
                        $log_value = substr($log_value, strpos($log_value, ";") + 1);
                        echo "<option>$log_value ºC</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" aria-label="Data de Atualização">
                    <option selected><?php echo $valor_hora; ?></option>
                    <?php
                    $log_values = explode("\n", $valor_log);
                    foreach ($log_values as $log_value) {
                        $log_value = substr($log_value, 0, strpos($log_value, ";"));
                        echo "<option>$log_value </option>";
                    }
                    ?>
                </select>
            </td>
            <td><span class="badge rounded-pill text-bg-danger">Elevado</span>
            </td>
            </tr>
            <tr>
            <td >Humidade</td>
            <td>
                <select class="form-select" aria-label="Estado de Alertas">
                    <option selected><?php echo $valor_humidade ?> %</option>
                    <?php
                    $log_values = explode("\n", $valor_log_humidade);
                    foreach ($log_values as $log_value) {
                        $log_value = substr($log_value, strpos($log_value, ";") + 1);
                        echo "<option>$log_value %</option>";
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" aria-label="Data de Atualização">
                    <option selected><?php echo $valor_hora_humidade ?></option>
                    <?php
                    $log_values = explode("\n", $valor_log_humidade);
                    foreach ($log_values as $log_value) {
                        $log_value = substr($log_value, 0, strpos($log_value, ";"));
                        echo "<option>$log_value</option>";
                    }
                    ?>
                </select>
            </td>
            <td><span class="badge rounded-pill text-bg-primary">Normal</span>
            </td>
            </tr>
            <tr>
            <td >Led Arduino</td>
            <td>
                <select class="form-select" aria-label="Estado de Alertas">
                    <option selected><?php echo $valor_led ?></option>
                    <?php
                        $log_values = explode("\n", $valor_log_led);
                        foreach ($log_values as $log_value) {
                            $log_value = substr($log_value, strpos($log_value, ";") + 1);
                            echo "<option>$log_value</option>";
                        }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" aria-label="Estado de Alertas">
                    <option selected><?php echo $valor_hora_led; ?></option>
                    <?php
                    $log_values = explode("\n", $valor_log_led);
                    foreach ($log_values as $log_value) {
                        $log_value = substr($log_value, 0, strpos($log_value, ";"));
                        echo "<option>$log_value</option>";
                    }
                    ?>
                </select>
            </td>
                </select>
            </td>
            <td><span class="badge rounded-pill text-bg-success">Ativo</span></td>
            </tr>

            </tr>
        </tbody>
        </table>
    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>