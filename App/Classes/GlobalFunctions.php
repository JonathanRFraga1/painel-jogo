<?php

namespace App\Classes;

use Exception;
use JetBrains\PhpStorm\Pure;
use stdClass;

class GlobalFunctions
{
    /**
     * Variavel para indexação da página
     *
     * @var string
     */
    public string $robots = 'noindex,nofollow';

    /**
     * Variável de título da página
     *
     * @var string
     */
    public string $title = 'Document';

    /**
     * Variável com os dados para a exibição da notificação
     *
     * @var array
     */
    public array $notification = array();

    /**
     * Variável com os dados para a exibição nas views
     *
     * @var stdClass
     */
    public stdClass $content;

    /**
     * Varriavel com os dados de erro para exibição
     *
     * @var Exception
     */
    public Exception $error;

    #[Pure] public function __construct()
    {
        $this->content = new stdClass();
    }

    /**
     * Verificação de login do usuário
     *
     * @return boolean
     */
    public function isLogged():bool
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Método para detcção de requisições POST
     *
     * @return boolean
     */
    public function isPost():bool
    {
        $type = $_SERVER['REQUEST_METHOD'];

        if ($type == 'POST') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Método para inclusão de views
     * @param string $view
     * @return void
     * @throws Exception
     */
    public function returnView(string $view):void
    {
        if (file_exists(ABSPATH . "/app/views/$view.php")) {
            require_once ABSPATH . "/app/views/$view.php";
        } else {
            throw new Exception("View não encontrada: /app/views/$view.php");
        }
    }

    /**
     * Método para inclusão de lotes views
     * @param array|string $views
     * @return void
     */
    public function includeViews(array|string $views, bool $includes = true):void
    {
        try {
            if ($includes) {
                $this->returnView('_includes/header');
            }

            if (is_array($views)) {
                foreach ($views as $view) {
                    $this->returnView($view);
                }
            } else {
                $this->returnView($views);
            }

            if ($includes) {
                $this->returnView('_includes/footer');
            }
        } catch (Exception $e) {
            $this->error = $e;
            $this->returnView('_includes/errors/error_500');
        }
    }

    public function redirect(string $url):void
    {
        header("Location: $url");
    }
}
