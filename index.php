<?php 
require_once __DIR__."/./DAO/usuarioDAO.php";
require_once __DIR__."/./Model/usuario.php";

if(isset($_POST['logar'])){

 $email = $_POST['email'];
 $senha = $_POST['senha'];
 $usuarioDAO =new usuarioDAO();

 $usuario = $usuarioDAO->getByEmail($email);
 if($usuario !== null && password_verify($senha,$usuario['senha'])){
header("location:frontend/gerenciar_usuario.php");
exit;
 }else{
    echo "Dados incorreto!";
 }


}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuários</title>
</head>
<body>
    <h1>Login de Usúarios</h1>
    <form action="" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email">
        </div>
            <div>
            <label for="senha">Senha:</label>
            <input type="password" name="senha">
        </div>
        <input type="submit" name="logar" value="Logar">
    </form>
 
</body>
</html>