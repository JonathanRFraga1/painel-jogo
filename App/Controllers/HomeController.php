<?php

namespace App\Controllers;

use App\Classes\GlobalFunctions;

class HomeController extends GlobalFunctions
{
    public function index()
    {
        $model = $this->loadModel('HomeModel');

        $model->retornaUsers();

        require_once ABSPATH . '/App/views/home/home-view.php';
    }
}
