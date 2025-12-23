<?php
require_once '../DAO/usuarioDAO.php';
$usuarioDAO= new usuarioDAO();
$suarios = $usuarioDAO->getAll();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerênciar Usuários</title>
</head>

<body>
    <h1>Gerênciar Usuários</h1>
    <table>
        <tr>
            <th>Id:</th>
            <th>Nome:</th>
            <th>Email:</th>
            <th>Senha:</th>
        </tr>
        <?php foreach($suarios as $usuario): ?>
            <tr>
                <td><?=$usuario->getId();?></td>
                <td><?=$usuario->getNome();?></td>
                <td><?=$usuario->getEmail();?></td>
                <td><?=$usuario->getSenha();?></td>
            </tr>
           <?php endforeach; ?>
    </table>
    <a href="cadastrar_usuario.php">Cadastrar</a>
</body>

</html>