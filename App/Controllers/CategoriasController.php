<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class CategoriasController extends GlobalFunctions
{
    private $model;

    public function __construct()
    {
        if (!$this->isLogged()) {
            header('Location:' . HOME_URI . '/login');
        }

        $this->model = $this->loadModel('CategoriasModel');
    }

    public function index()
    {
        require_once ABSPATH . '/App/views/_includes/header.php';
        require_once ABSPATH . '/App/views/categorias/categorias-view.php';
        require_once ABSPATH . '/App/views/_includes/footer.php';
    }
}
