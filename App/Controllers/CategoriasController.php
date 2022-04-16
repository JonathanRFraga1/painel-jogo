<?php

namespace App\Controllers;

use App\Abstracts\AbstractController;
use App\Models\CategoriasModel;
use Exception;

class CategoriasController extends AbstractController
{
    private ?object $defaultModel;

    public function __construct()
    {
        parent::__construct();

        if (!$this->isLogged()) {
            $this->redirect(HOME_URI . '/login');
        }

        try {
            $this->defaultModel = new CategoriasModel();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function index()
    {
        $this->includeViews('categorias/categorias-view');
    }
}
