<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\ConexaoBanco;
use PDO;

// Classe responsável por gerenciar os usuários no sistema, incluindo operações de busca por email e ID
final class Usuario {
    // aqui é onde a conexão com o banco de dados é obtida, utilizando as configurações definidas no arquivo database.ini
    private static function pdo(): PDO {
        $cfg = dirname(__DIR__, 2) . '/config/database.ini';
        return ConexaoBanco::obterConexao($cfg);
    }

    // aqui é onde a busca de um usuário específico por email é feita, retornando os detalhes do usuário, incluindo o hash da senha e o perfil
    public static function buscarPorEmail(string $email): ?array {
        $sql = "SELECT id, nome, email, senha_hash, perfil FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute([':email' => trim($email)]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    // aqui é onde a busca de um usuário específico por ID é feita, retornando os detalhes do usuário, incluindo o nome, email e perfil
    public static function buscarPorId(int $id): ?array {
        $sql = "SELECT id, nome, email, perfil FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute([':id' => $id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }
}