<?php

namespace App\Controllers;

use App\Abstracts\AbstractController;
use App\Models\CategoriasModel;
use Exception;

class CategoriasController extends AbstractController
{
    /**
     * @var CategoriasModel
     */
    private CategoriasModel $defaultModel;

    public function __construct()
    {
        parent::__construct();

        if (!$this->isLogged()) {
            $this->redirect(HOME_URI . '/login');
        }

        try {
            $this->defaultModel = $this->loadModel(CategoriasModel::class);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function index()
    {
        $this->defaultModel->returnCategorias();
        $this->includeViews('categorias/categorias-view');
    }
}
