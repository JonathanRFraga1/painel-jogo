<?php

namespace App\Abstracts;

use App\Classes\GlobalFunctions;
use Exception;

abstract class AbstractController extends GlobalFunctions
{
    private ?object $defaultModel;

    public abstract function index();
}
