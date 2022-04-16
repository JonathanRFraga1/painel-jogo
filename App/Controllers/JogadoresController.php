<?php

namespace App\Controllers;

use App\Abstracts\AbstractController;
use App\Models\JogadoresModel;
use Exception;

class JogadoresController extends AbstractController
{
    private ?object $defaultModel;

    public function __construct()
    {
        parent::__construct();


        if (!$this->isLogged()) {
            $this->redirect(HOME_URI . '/login');
        }

        try {
            $this->defaultModel = new JogadoresModel();
        } catch (Exception $e) {
            $this->error = $e;
            $this->includeViews('_includes/errors/error_500');
            exit;
        }
    }

    public function index()
    {
        $this->title = 'Jogadores';

        $this->content->jogadores = $this->defaultModel->retornaJogadores();

        $this->includeViews('jogadores/jogadores-view');
    }

    public function inserir()
    {
        $this->title = 'Cadastrar Jogador';

        if ($this->isPost()) {
            $resposta = $this->defaultModel->insereJogador($_POST);

            if ($resposta == 'sucesso') {
                $this->notification['type'] = 'success';
                $this->notification['title'] = 'Successo';
                $this->notification['content'] = 'Jogador cadastrado com sucesso';
            } else {
                $this->notification['type'] = 'error';
                $this->notification['title'] = 'Erro';
                $this->notification['content'] = $resposta;
            }
        }

        $this->includeViews('jogadores/inserir');
    }

    public function buscaTexto()
    {
        if (!$this->isPost()) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Nenhum usuario encontrado', true, 500);
            echo 'Nenhum usuário encontrado';
            return;
        }

        $retorno = $this->defaultModel->retornaJogadoresString($_POST['texto']);

        echo json_encode($retorno);
    }
}
