<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class LoginController extends GlobalFunctions
{
    public function index()
    {
        if ($this->isLogged()) {
            header('Location:' . HOME_URI);
        }
    }
}
