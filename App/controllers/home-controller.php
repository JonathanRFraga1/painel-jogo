<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        require_once ABSPATH . '/App/views/home/home-view.php';
    }
}
