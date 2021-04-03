<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class UsuariosController extends GlobalFunctions
{
    private $model;

    public function __construct()
    {
        if (!$this->isLogged()) {
            header('Location:' . HOME_URI . '/login');
        }

        $this->model = $this->loadModel('UsuariosModel');
    }

    public function index()
    {
        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/usuarios/usuarios-view.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }
}
