<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class JogadoresController extends GlobalFunctions
{
    private object $model;

    public function __construct()
    {
        if (!$this->isLogged()) {
            header('Location:' . HOME_URI . '/login');
        }

        $this->model = $this->loadModel('JogadoresModel');
    }

    public function index()
    {
        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/jogadores/jogadores-view.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }
}
