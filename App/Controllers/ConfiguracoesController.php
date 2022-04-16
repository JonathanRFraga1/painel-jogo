<?php

namespace App\Controllers;

use App\Abstracts\AbstractController;
use App\Models\ConfiguracoesModel;
use Exception;

class ConfiguracoesController extends AbstractController
{
    private ?object $defaultModel;

    public function __construct()
    {
        parent::__construct();

        if (!$this->isLogged()) {
            $this->redirect(HOME_URI . '/login');
        }

        try {
            $this->defaultModel = new ConfiguracoesModel();
        } catch (Exception $e) {
            $this->error = $e;
            $this->includeViews('_includes/errors/error_500');
            exit;
        }
    }

    public function index()
    {
        $this->includeViews('configuracoes/configuracoes-view');
    }
}
