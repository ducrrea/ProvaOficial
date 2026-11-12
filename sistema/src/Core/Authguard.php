<?php
declare(strict_types=1);

namespace App\Core;

// Classe responsável por proteger rotas que exigem autenticação do usuário
final class AuthGuard {
    public static function proteger(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!self::usuarioLogado()) {
            header("Location: /login");
            exit;
        }
        if (self::sessaoExpirada()) {
            self::encerrarSessaoPorExpiracao();
        }
        $_SESSION['ultimo_acesso'] = time();
    }

    // Verifica se o usuário está logado, retornando verdadeiro se houver um ID de usuário na sessão
    public static function usuarioLogado(): bool {
        return !empty($_SESSION['usuario_id']);
    }

    // Verifica se a sessão do usuário expirou com base no tempo de inatividade configurado
    private static function sessaoExpirada(): bool {
        $cfg = parse_ini_file(dirname(__DIR__, 2) . '/config/database.ini', true);
        $limite = (int)($cfg['security']['session_timeout'] ?? 900);
        $ultimoAcesso = $_SESSION['ultimo_acesso'] ?? time();
        return (time() - $ultimoAcesso) > $limite;
    }

    // Encerra a sessão do usuário e redireciona para a página de login com uma mensagem de expiração
    private static function encerrarSessaoPorExpiracao(): void {
        $_SESSION = [];
        session_destroy();
        header("Location: /login?expirada=1");
        exit;
    }
}