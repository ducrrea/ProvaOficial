<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Pet;
use App\Models\Tutor;

final class PetController extends Controller {

    // Listagem de todos os pets cadastrados no sistema
    public function listar(): void {
        $pets = Pet::listarTodos();
        $this->renderizar('pets/listar', [
            'titulo' => 'Gerenciamento de pets',
            'pets'   => $pets
        ]);
    }

    //  Exibe o formulário para cadastrar um novo pet, incluindo a lista de tutores disponíveis
    public function formulario(): void {
        $tutores = Tutor::listar();
        $this->renderizar('pets/criar', [
            'titulo'    => 'Cadastrar novo pet',
            'tutores'   => $tutores,
            'csrfToken' => $this->obterCsrfToken()
        ]);
    }

    // Salva um novo pet no banco de dados, associando-o a um tutor existente
    public function salvar(): void {
        if (!$this->validarCsrfToken($_POST['csrf_token'] ?? null)) {
            $this->redirecionar('/pets');
        }
        $tutorId = (int)($_POST['tutor_id'] ?? 0);
        $nome    = trim($_POST['nome'] ?? '');
        $especie = trim($_POST['especie'] ?? '');
        $raca    = trim($_POST['raca'] ?? '');
        $dtNasc  = trim($_POST['data_nascimento'] ?? '');

        if ($tutorId > 0 && $nome !== '' && $especie !== '' && $dtNasc !== '') {
            Pet::salvar($tutorId, $nome, $especie, $raca, $dtNasc);
            $this->redirecionar('/pets');
        }

        // Renderiza novamente o formulário de cadastro de pet com uma mensagem de erro caso os dados obrigatórios não tenham sido preenchidos corretamente
        $this->renderizar('pets/criar', [
            'titulo'    => 'Cadastrar Novo Pet',
            'erro'      => 'É obrigatório selecionar um tutor e preencher os dados do animal.',
            'tutores'   => Tutor::listar(),
            'csrfToken' => $this->obterCsrfToken()
        ]);
    }
}