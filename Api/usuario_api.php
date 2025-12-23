<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Pré-flight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once '../DAO/UsuarioDAO.php';
require_once '../Model/Usuario.php';
$usuarioDAO = new UsuarioDAO();

$action = $_GET['action'] ?? null;
$id     = $_GET['id'] ?? null;
$inputBody = json_decode(file_get_contents('php://input'), true);

switch ($action) {
/* ================= LOGIN ================= */
case 'logar':

    header('Content-Type: application/json; charset=utf-8');

    // Verifica se email e senha foram enviados
    if (!isset($_POST['email']) || !isset($_POST['senha'])) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "error" => "Email e senha são obrigatórios!"
        ]);
        exit;
    }

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    // Busca o usuário pelo email
    $usuario = $usuarioDAO->getByEmail($email);

    if (!$usuario) {
        http_response_code(404);
        echo json_encode([
            "success" => false,
            "error" => "Usuário não encontrado!"
        ]);
        exit;
    }

    // 🔐 ATENÇÃO AQUI → array, NÃO objeto
    if (password_verify($senha, $usuario['senha'])) {

        http_response_code(200);
        echo json_encode([
            "success" => true,
            "message" => "Login realizado com sucesso!",
            "usuario" => [
                "id"    => $usuario['id'],
                "nome"  => $usuario['nome'],
                "email" => $usuario['email']
                // ❌ nunca retorne a senha
            ]
        ]);
        exit;

    } else {
        http_response_code(401);
        echo json_encode([
            "success" => false,
            "error" => "Senha incorreta!"
        ]);
        exit;
    }

    break;


    /* ================= LISTAR ================= */
    case 'listar':
        echo json_encode($usuarioDAO->getAll());
        break;

    /* ================= BUSCAR ================= */
    case 'buscar':

        if (!$id) {
            http_response_code(400);
            echo json_encode(["error" => "ID não informado!"]);
            break;
        }

        $usuario = $usuarioDAO->getById($id);

        if (!$usuario) {
            http_response_code(404);
            echo json_encode(["error" => "Usuário não encontrado!"]);
            break;
        }

        echo json_encode($usuario);
        break;

    /* ================= CADASTRAR ================= */
case 'cadastrar':

    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            "success" => false,
            "error" => "Método não permitido!"
        ]);
        break;
    }

    // Recebe dados do POST tradicional (Flutter)
    if (
        !isset($_POST['nome']) ||
        !isset($_POST['email']) ||
        !isset($_POST['senha'])
    ) {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "error" => "Dados obrigatórios não enviados!"
        ]);
        break;
    }

    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    if ($nome === '' || $email === '' || $senha === '') {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "error" => "Campos inválidos!"
        ]);
        break;
    }

    // 🔐 Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $usuario = new Usuario(
        null,
        $nome,
        $email,
        $senhaHash
    );

    if ($usuarioDAO->create($usuario)) {
        http_response_code(201);
        echo json_encode([
            "success" => true,
            "message" => "Usuário cadastrado com sucesso!"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "error" => "Erro ao cadastrar usuário!"
        ]);
    }

    break;


    /* ================= ATUALIZAR ================= */
    case 'atualizar':

        if ($_SERVER['REQUEST_METHOD'] !== 'PUT' || !$id || !$inputBody) {
            http_response_code(400);
            echo json_encode(["error" => "ID, método ou dados inválidos!"]);
            break;
        }

        $senhaHash = password_hash($inputBody['senha'], PASSWORD_DEFAULT);

        $usuario = new Usuario(
            $id,
            $inputBody['nome'],
            $inputBody['sobrenome'],
            $inputBody['email'],
            $senhaHash,
        
        );

        if ($usuarioDAO->update($usuario)) {
            echo json_encode(["message" => "Usuário atualizado com sucesso!"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao atualizar usuário!"]);
        }
        break;

    /* ================= EXCLUIR ================= */
    case 'excluir':

        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE' || !$id) {
            http_response_code(400);
            echo json_encode(["error" => "ID ou método inválido!"]);
            break;
        }

        if ($usuarioDAO->excluir($id)) {
            echo json_encode(["message" => "Usuário excluído com sucesso!"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Erro ao excluir usuário!"]);
        }
        break;

    /* ================= DEFAULT ================= */
    default:
        http_response_code(400);
        echo json_encode(["error" => "Ação inválida! Informe o parâmetro action."]);
}

