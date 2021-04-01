<?php

namespace App\Classes;

class GlobalFunctions
{
    /**
     * Verificação de login do usuário
     *
     * @return boolean
     */
    public function isLogged()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

    public function loadModel(string $model)
    {
        require_once '../models/' . $model;
    }
}
