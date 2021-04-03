<?php

namespace App\Models;

use App\Classes\Database;

class JogadoresModel
{
    private object $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
