<?php

namespace App\Models;

use PDO;
use App\Classes\Database;

class HomeModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
