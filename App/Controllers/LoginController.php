<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class LoginController extends GlobalFunctions
{
    public function index()
    {
        if ($this->isLogged()) {
            header('Location:' . HOME_URI);
        }

        $this->robots = "index,nofollow";
        $this->title = "Login";

        require_once ABSPATH . '/app/views/login/login-view.php';
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

        $model = $this->loadModel('LoginModel');
        $retorno = $model->retornaUsuarioLogin($params['login']);

        if (!$retorno) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Usuario nao encontrado', true, 500);
            echo 'Usuário não encontrado';
            return;
        }

        $retorno = $model->realizaLogin($params['senha'], $retorno);

        if (!$retorno) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Senha Incorreta', true, 500);
            echo 'Senha Incorreta';
            return;
        }
    }
}
