<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class PalavrasController extends GlobalFunctions
{
    private $model;

    public function __construct()
    {
        if (!$this->isLogged()) {
            header('Location:' . HOME_URI . '/login');
        }

        $this->model = $this->loadModel('PalavrasModel');
    }

    public function index()
    {
        require_once ABSPATH . '/app/views/_includes/header.php';
        require_once ABSPATH . '/app/views/palavras/palavras-view.php';
        require_once ABSPATH . '/app/views/_includes/footer.php';
    }
}
