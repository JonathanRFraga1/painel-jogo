<?php

namespace App\Controllers;

use App\Abstracts\AbstractController;
use App\Models\LoginModel;
use Exception;

class LoginController extends AbstractController
{
    public ?object $defaultModel;

    public function __construct()
    {
        parent::__construct();

        try {
            $this->defaultModel = new LoginModel();
        } catch (Exception $e) {
            $this->error = $e;
            $this->includeViews('_includes/errors/error_500');
            exit;
        }
    }

    public function index()
    {
        if ($this->isLogged()) {
            $this->redirect(HOME_URI);
        }

        $this->robots = "index,nofollow";
        $this->title = "Login";

        $this->includeViews('login/login-view', false);
    }

    public function efetuaLogin()
    {
        $params = $_POST;

        if (
            !isset($params['login']) ||
            $params['login'] == '' ||
            !isset($params['senha']) ||
            $params['senha'] == ''
        ) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Usuario ou senha nao enviados', true, 500);
            echo 'Usuário ou senha não enviados';
            return;
        }

        $retorno = $this->defaultModel->retornaUsuarioLogin($params['login']);

        if (!$retorno) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Usuario nao encontrado', true, 500);
            echo 'Usuário não encontrado';
            return;
        }

        $retorno = $this->defaultModel->realizaLogin($params['senha'], $retorno);

        if (!$retorno) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Senha Incorreta', true, 500);
            echo 'Senha Incorreta';
            return;
        }
    }

    public function sair()
    {
        if ($this->isLogged()) {
            $this->defaultModel->realizaLogout();
        }
    }
}
