<?php 
require_once  __DIR__."/../DAO/usuarioDAO.php";
require_once __DIR__."/../Model/usuario.php";
$usarioDAO = new usuarioDAO();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha =$_POST['senha'];
    $senhaHash=password_hash($senha,PASSWORD_DEFAULT); 

      $usuario = new Usuario(null,$nome,$email,$senhaHash);
      if($usarioDAO->create($usuario)){
      echo "Usuário cadastrado com sucesso!";
      }else{
           echo "Erro ao cadastrar!"; 
      }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuários</title>
</head>
<body>
    <h1>Cadastrar Usuários</h1>
    <form action="" method="post">
     <div>
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required>
     </div>
       <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
     </div>
       <div>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha"requerid>
     </div>
     <button type="submit">Cadastrar</button>
    </form> 
    <a href="gerenciar_usuario.php">Lista</a>
</body>
</html>