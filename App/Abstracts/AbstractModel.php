<?php

namespace App\Abstracts;

use App\Classes\Database;
use App\Classes\GlobalFunctions;
use Exception;
use PDO;

abstract class AbstractModel extends GlobalFunctions
{
    protected Database $db;

    public function __construct()
    {
        parent::__construct();

        $this->db = new Database();
    }
}
