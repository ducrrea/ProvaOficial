<?php
declare(strict_types=1);

namespace App\Core;

final class Criptografia {
    //Classe para criptografia do CPF
     private static function obterChave(): string {
        $cfg = parse_ini_file(dirname(__DIR__, 2) . '/config/database.ini', true);
        return hash('sha256', (string)($cfg['security']['app_key'] ?? 'padrao'));
    }

    // aqui é onde a criptografia do CPF é feita, utilizando AES-256-CBC com um IV aleatório
    public static function cifrar(string $dado): string {
        $iv = random_bytes(16);
        $cifrado = openssl_encrypt($dado, 'aes-256-cbc', self::obterChave(), 0, $iv);
        return base64_encode($iv . $cifrado);
    }

    // aqui é onde a descriptografia do CPF é feita, utilizando AES-256-CBC com o IV extraído do dado cifrado
    public static function decifrar(string $dadoCifrado): string {
        $dadosBrutos = base64_decode($dadoCifrado);
        $iv = substr($dadosBrutos, 0, 16);
        $texto = substr($dadosBrutos, 16);
        $resultado = openssl_decrypt($texto, 'aes-256-cbc', self::obterChave(), 0, $iv);
        return $resultado !== false ? $resultado : '***.***.***-**';
    }
}