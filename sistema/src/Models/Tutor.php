<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\ConexaoBanco;
use App\Core\Criptografia;
use PDO;

// Classe responsável por gerenciar os tutores no sistema, incluindo operações de listagem, busca, salvamento e atualização
final class Tutor {
    // aqui é onde a conexão com o banco de dados é obtida, utilizando as configurações definidas no arquivo database.ini
    private static function pdo(): PDO {
        $cfg = dirname(__DIR__, 2) . '/config/database.ini';
        return ConexaoBanco::obterConexao($cfg);
    }

    // aqui é onde a listagem de tutores é feita, permitindo filtrar por um termo de busca opcional, e descriptografando os CPFs antes de retornar os resultados
    public static function listar(?string $termo = null): array {
        if (!empty($termo)) {
            $sql = "SELECT id, nome, cpf_criptografado, telefone, email, criado_em 
                    FROM tutores 
                    WHERE nome ILIKE :termo OR email ILIKE :termo OR telefone ILIKE :termo 
                    ORDER BY nome ASC";
            $stmt = self::pdo()->prepare($sql);
            $stmt->execute([':termo' => '%' . trim($termo) . '%']);
            $registros = $stmt->fetchAll();
        } else {
            $sql = "SELECT id, nome, cpf_criptografado, telefone, email, criado_em FROM tutores ORDER BY nome ASC";
            $registros = self::pdo()->query($sql)->fetchAll();
        }
        return self::descriptografarColecao($registros);
    }

    // aqui é onde a busca de um tutor específico por ID é feita, retornando os detalhes do tutor, incluindo o CPF descriptografado
    public static function buscarPorId(int $id): ?array {
        $sql = "SELECT id, nome, cpf_criptografado, telefone, email FROM tutores WHERE id = :id LIMIT 1";
        $stmt = self::pdo()->prepare($sql);
        $stmt->execute([':id' => $id]);
        $tutor = $stmt->fetch();
        if ($tutor) {
            $tutor['cpf'] = Criptografia::decifrar($tutor['cpf_criptografado']);
        }
        return $tutor ?: null;
    }

    // aqui é onde a inserção de um novo tutor no banco de dados é feita, criptografando o CPF antes de armazená-lo
    public static function salvar(string $nome, string $cpf, string $telefone, string $email): bool {
        $sql = "INSERT INTO tutores (nome, cpf_criptografado, telefone, email) 
                VALUES (:nome, :cpf, :telefone, :email)";
        $stmt = self::pdo()->prepare($sql);
        return $stmt->execute([
            ':nome'     => trim($nome),
            ':cpf'      => Criptografia::cifrar(trim($cpf)),
            ':telefone' => trim($telefone),
            ':email'    => trim($email)
        ]);
    }

    // aqui é onde a atualização dos dados de um tutor existente é feita, permitindo alterar o nome, CPF, telefone e email, com o CPF sendo criptografado antes de ser armazenado
    public static function atualizar(int $id, string $nome, string $cpf, string $tel, string $email): bool {
        $sql = "UPDATE tutores 
                SET nome = :nome, cpf_criptografado = :cpf, telefone = :tel, email = :email 
                WHERE id = :id";
        $stmt = self::pdo()->prepare($sql);
        return $stmt->execute([
            ':nome'  => trim($nome),
            ':cpf'   => Criptografia::cifrar(trim($cpf)),
            ':tel'   => trim($tel),
            ':email' => trim($email),
            ':id'    => $id
        ]);
    }

    // aqui é onde a descriptografia dos CPFs de uma coleção de tutores é feita, iterando sobre cada item e aplicando a função de decifragem
    private static function descriptografarColecao(array $itens): array {
        foreach ($itens as &$item) {
            $item['cpf'] = Criptografia::decifrar($item['cpf_criptografado']);
        }
        return $itens;
    }
}