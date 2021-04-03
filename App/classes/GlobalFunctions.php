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
        if (file_exists(ABSPATH . '/app/models/' . $model . '.php')) {
            require_once ABSPATH . '/app/models/' . $model . '.php';

            $namespace = 'App\\Models\\' . $model;

            return new $namespace();
        } else {
            die("Arquivo não encontrado");
        }
    }
}
