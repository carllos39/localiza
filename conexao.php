<?php 
class Conexao {
    public static function getInstance() {
        $db_host = "localhost";
        $db_name = "localizadb";
        $db_user = "root";
        $db_pass = "";

        try {
            $pdo = new PDO(
                "mysql:host={$db_host};dbname={$db_name};charset=utf8",
                $db_user,
                $db_pass
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;

        } catch (PDOException $e) {
            // Em produção, gravar isso em log
            die(json_encode(["error" => "Erro de conexão: " . $e->getMessage()]));
        }
    }
}


?>