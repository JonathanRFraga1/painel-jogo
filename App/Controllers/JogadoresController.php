<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class JogadoresController extends GlobalFunctions
{
    private $model;

    public function __construct()
    {
        if (!$this->isLogged()) {
            header('Location:' . HOME_URI . '/login');
        }

        $this->model = $this->loadModel('JogadoresModel');
    }

    public function index()
    {
        $this->title = 'Jogadores';

        $this->jogadores = $this->model->retornaJogadores();

        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/jogadores/jogadores-view.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }

    public function inserir()
    {
        $this->title = 'Cadastrar Jogador';

        if ($this->isPost()) {
            $resposta = $this->model->insereJogador($_POST);

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

        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/jogadores/inserir.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }

    public function buscaTexto()
    {
        if (!$this->isPost()) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Nenhum usuario encontrado', true, 500);
            echo 'Nenhum usuário encontrado';
            return;
        }

        $retorno = $this->model->retornaJogadoresString($_POST['texto']);

        echo json_encode($retorno);
    }
}
