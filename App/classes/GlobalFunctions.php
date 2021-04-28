<?php

namespace App\Classes;

class GlobalFunctions
{
    /**
     * Variavel para indexação da página
     *
     * @var string
     */
    public $robots = 'noindex,nofollow';

    /**
     * Variável de título da página
     *
     * @var string
     */
    public $title = 'Document';

    /**
     * Variável com os dados para a exibição da notificação
     *
     * @var array
     */
    public $notification = array();

    /**
     * Verificação de login do usuário
     *
     * @return boolean
     */
    public function isLogged()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Função responsável pelo carregamento automatico das models
     *
     * @param string $model
     * @return object
     */
    public function loadModel(string $model)
    {
        if (file_exists(ABSPATH . '/app/Models/' . $model . '.php')) {
            require_once ABSPATH . '/app/Models/' . $model . '.php';

            $namespace = 'App\\Models\\' . $model;

            return new $namespace();
        } else {
            die("Arquivo não encontrado");
        }
    }

    /**
     * Método para detcção de requisições POST
     *
     * @return boolean
     */
    public function isPost()
    {
        $type = $_SERVER['REQUEST_METHOD'];

        if ($type == 'POST') {
            return true;
        } else {
            return false;
        }
    }
}
