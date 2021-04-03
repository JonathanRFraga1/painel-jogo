<?php

namespace App\Models;

use App\Classes\Database;

class JogadoresModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
