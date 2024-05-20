<?php
session_start();

//função para validar o username e password 
function validateuser($username, $password){

  //lê as crendências dos users para uma string
  $credentials = file('user.txt', FILE_IGNORE_NEW_LINES);

  foreach ($credentials as $credential) {
    //Divide o username e a password pelo ':'
    list($storedUsername, $storedhashpassword) = explode(':', $credential);

    //Verifica se o username e a password são iguais
    if ($username === $storedUsername && password_verify($password, $storedhashpassword)) {
      return true;
    }
  }
  return false;

}

//Verifica se o form foi submetido corretamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  
  // Verificar se o nome do user e a password correspondem
  if (validateuser($username, $password)) {
    // Login com sucesso
    $_SESSION['username'] = $username; // Cria a variavel de sessão para o 'username'
    header("refresh:0;url=Dashboard.php");//redireciona para a página 'dashboard.php'
  } else {
    // Login failed
    echo "Nome do user ou senha inválidos";
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <div class ="container">
      <div class="row">
      <form method="POST" id="TIform">
        <a href="/index.php"><img src="imagens/estg_login.png" alt="logo"></a>

        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Insira o seu username" id="username" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
            </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Insira a sua password" id="password" required>
        <div class="valid-feedback">Valid.</div>
        <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <button type="submit" class="btn btn-primary" value="login">Submeter</button>
      </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
<!--meter imagem de fundo-->
<!--olocar mensagem de login invalido por baixo das caias de login-->