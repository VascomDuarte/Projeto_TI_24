<?php

header('Content-Type: text/html; charset=utf-8');

error_reporting(E_ALL);
ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['nome'],$_POST['valor'],$_POST['hora'])){
            $valorFile = "files/".$_POST['nome']."/valor.txt";
            $horaFile = "files/".$_POST['nome']."/hora.txt";
            $logFile = "files/".$_POST['nome']."/log.txt";

            // Verificar se o diretório existe ou criar se não existir
            if (!file_exists("files/".$_POST['nome'])) {
                mkdir("files/".$_POST['nome'], 0777, true);
            }

            // Escrever nos arquivos
            file_put_contents($valorFile, $_POST['valor']);
            file_put_contents($horaFile, $_POST['hora']);
            file_put_contents($logFile, ($_POST['hora']."; ".$_POST['valor'].PHP_EOL), FILE_APPEND);

            echo "Dados gravados com sucesso!";
        } else {
            http_response_code(400);
            echo "Parâmetros incompletos!";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(isset($_GET["nome"])){
            $valorFile = "files/".$_GET['nome']."/valor.txt";
            
            // Verificar se o arquivo existe antes de tentar lê-lo
            if (file_exists($valorFile)) {
                echo file_get_contents($valorFile);
            } else {
                http_response_code(404);
                echo "Arquivo não encontrado!";
            }
        } else{
            http_response_code(400);
            echo "Parâmetros incompletos!";
        }
    } else{
        http_response_code(403);
        echo "Método não permitido!";
    }
?>
