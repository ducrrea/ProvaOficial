<?php
declare(strict_types=1);

namespace App\Core;

// Classe responsável por gerenciar o roteamento das requisições HTTP para os controladores apropriados
final class Roteador {
    private array $rotas = [];

    // Registra uma nova rota no roteador, associando um método HTTP, uma URI, uma ação (controlador e método) e possíveis guards de autenticação
    public function registrar(string $metodo, string $uri, array $acao, array $guards = []): void {
        $uriNormalizada = '/' . trim($uri, '/');
        $this->rotas[strtoupper($metodo)][$uriNormalizada] = [
            'acao'   => $acao,
            'guards' => $guards
        ];
    }

    //onde o roteador despacha a requisição para o controlador correto, verificando se a rota existe e aplicando os guards de autenticação antes de chamar o método do controlador
    public function despachar(string $metodo, string $uri): void {
        $uriLimpa = '/' . trim((string)parse_url($uri, PHP_URL_PATH), '/');
        $metodoHttp = strtoupper($metodo);
        if (isset($this->rotas[$metodoHttp][$uriLimpa])) {
            $registro = $this->rotas[$metodoHttp][$uriLimpa];
            foreach ($registro['guards'] as $guard) {
                [$classeGuard, $metodoGuard] = $guard;
                $classeGuard::$metodoGuard();
            }
            [$classeController, $nomeMetodo] = $registro['acao'];
            (new $classeController())->$nomeMetodo();
            return;
        }
        http_response_code(404);
        echo "<h2 style='font-family:sans-serif;text-align:center;'>404 - Rota Nao Encontrada</h2>";
    }
}