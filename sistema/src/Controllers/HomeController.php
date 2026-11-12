<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Tutor;
use App\Models\Pet;
use App\Models\Agendamento;

//
final class HomeController extends Controller {
    public function index(): void {
        $usuarioNome = $_SESSION['usuario_nome'] ?? 'Operador';
        $totalTutores = count(Tutor::listar());
        $totalPets = Pet::totalPets();
        $agendamentosRecentes = array_slice(Agendamento::listarOrdenadoPorAno(), 0, 5);

        // Renderiza a view do painel principal, passando os dados necessários para exibição
        $this->renderizar('home/index', [
            'titulo'               => 'Painel Principal - ClinicAu',
            'usuarioNome'          => $usuarioNome,
            'totalTutores'         => $totalTutores,
            'totalPets'            => $totalPets,
            'agendamentosRecentes' => $agendamentosRecentes
        ]);
    }
}