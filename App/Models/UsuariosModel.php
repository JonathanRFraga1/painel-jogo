<?php

namespace App\Models;

use PDO;
use App\Classes\Database;

class HomeModel
{
    private object $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function retornaUsers()
    {
        $query = $this->db->query("SELECT * FROM users");

        $query = $query->fetch(PDO::FETCH_ASSOC);

        echo "<pre>";

        print_r($query);
    }
}
