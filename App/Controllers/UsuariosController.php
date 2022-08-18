<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;
use App\Models\UsuariosModel;
use Exception;

class UsuariosController extends GlobalFunctions
{
    /**
     * @var UsuariosModel
     */
    private UsuariosModel $defaultModel;

    public function __construct()
    {
        parent::__construct();


        if (!$this->isLogged()) {
            $this->redirect(HOME_URI . '/login');
        }

        try {
            $this->defaultModel = $this->loadModel(UsuariosModel::class);
        } catch (Exception $e) {
            $this->error = $e;
            $this->includeViews('_includes/errors/error_500');
            exit;
        }
    }

    public function index()
    {
        $this->includeViews('usuarios/usuarios-view');
    }
}
