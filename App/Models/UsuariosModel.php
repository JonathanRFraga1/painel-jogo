<?php

namespace App\Models;

use App\Abstracts\AbstractModel;
use PDO;

class UsuariosModel extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function retornaUsers()
    {
        $query = $this->db->query("SELECT * FROM users");

        $query = $query->fetch(PDO::FETCH_ASSOC);

        echo "<pre>";

        print_r($query);
    }
}
