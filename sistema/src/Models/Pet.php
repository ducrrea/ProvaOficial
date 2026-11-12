<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\ConexaoBanco;
use PDO;

// Classe responsável por gerenciar os pets no sistema, incluindo operações de listagem, busca e salvamento
final class Pet {
    private static function pdo(): PDO {
        $cfg = dirname(__DIR__, 2) . '/config/database.ini';
        return ConexaoBanco::obterConexao($cfg);
    }

    // aqui é onde a listagem de todos os pets é feita, incluindo informações do tutor associado, ordenando pelo nome do pet
    public static function listarTodos(): array {
        $sql = "SELECT p.id, p.nome, p.especie, p.raca, p.data_nascimento, t.nome AS tutor_nome, t.id AS tutor_id
                FROM pets p
                JOIN tutores t ON t.id = p.tutor_id
                ORDER BY p.nome ASC";
        return self::pdo()->query($sql)->fetchAll();
    }

    // aqui é onde a busca de um pet específico por ID é feita, retornando os detalhes do pet e do tutor associado
    public static function buscarPorId(int $id): ?array {
        $sql = "SELECT id, tutor_id, nome, especie, raca, data_nascimento FROM pets WHERE id = :id LIMIT 1";
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute([':id' => $id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    // aqui é onde a inserção de um novo pet no banco de dados é feita, associando o pet a um tutor existente
    public static function salvar(int $tutorId, string $nome, string $esp, string $raca, string $dtNasc): bool {
        $sql = "INSERT INTO pets (tutor_id, nome, especie, raca, data_nascimento) 
                VALUES (:tutor_id, :nome, :especie, :raca, :data_nascimento)";
        $stmt = self::pdo()->prepare($sql);
        return $stmt->execute([
            ':tutor_id'        => $tutorId,
            ':nome'            => trim($nome),
            ':especie'         => trim($esp),
            ':raca'            => trim($raca),
            ':data_nascimento' => $dtNasc
        ]);
    }

    // aqui é onde a contagem total de pets cadastrados no sistema é feita, retornando o número total de registros na tabela de pets
    public static function totalPets(): int {
        $sql = "SELECT COUNT(id) FROM pets";
        return (int)self::pdo()->query($sql)->fetchColumn();
    }
}