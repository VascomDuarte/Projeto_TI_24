<?php
session_start(); // Inicia a sessão
session_unset(); // Limpa a sessão
session_destroy();  // Destroi a sessão
header("refresh:0;url=index.php"); // Redireciona para a página de login
?>  