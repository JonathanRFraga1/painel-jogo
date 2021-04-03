<?php

namespace App\Models;

use PDO;
use App\Classes\Database;

class PalavrasModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
