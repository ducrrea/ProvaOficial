<?php
declare(strict_types=1);

namespace App\Core;
use PDO;
use Exception;

// Classe responsável por gerenciar a conexão com o banco de dados utilizando o padrão Singleton
final class ConexaoBanco {
    // Instância única da conexão com o banco de dados
    private static ?PDO $instancia = null;

    // Construtor privado para impedir a criação de instâncias externas
    private function __construct() {}
    private function __clone(): void {}

    // Impede a desserialização da instância, garantindo que apenas uma instância seja utilizada
    public function __wakeup(): void {
        throw new Exception("Desserializacao nao permitida.");
    }

    // Retorna a instância única da conexão com o banco de dados, criando-a se ainda não existir
    public static function obterConexao(string $caminhoConfig): PDO {
        if (self::$instancia === null) {
            $dados = parse_ini_file($caminhoConfig, true);
            $cfg = $dados['database'];
            $dsn = sprintf("%s:host=%s;port=%s;dbname=%s",
                $cfg['db_driver'], $cfg['db_host'], $cfg['db_port'], $cfg['db_name']);
            self::$instancia = new PDO($dsn, $cfg['db_user'], $cfg['db_pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ]);
        }
        return self::$instancia;
    }
}