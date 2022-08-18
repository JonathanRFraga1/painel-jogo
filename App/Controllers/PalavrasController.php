<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;
use App\Models\LoginModel;
use App\Models\PalavrasModel;
use Exception;

class PalavrasController extends GlobalFunctions
{
    /**
     * @var LoginModel
     */
    private LoginModel $defaultModel;

    public function __construct()
    {
        parent::__construct();


        if (!$this->isLogged()) {
            $this->redirect(HOME_URI . '/login');
        }

        try {
            $this->defaultModel = $this->loadModel(LoginModel::class);
        } catch (Exception $e) {
            $this->error = $e;
            $this->includeViews('_includes/errors/error_500');
            exit;
        }
    }

    public function index()
    {
        $this->includeViews('palavras/palavras-view');
    }
}
