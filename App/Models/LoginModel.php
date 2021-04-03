<?php

namespace App\Models;

use PDO;
use App\Classes\Database;

class LoginModel
{
    private object $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Função responsável por retornar o usuário no banco de dados
     *
     * @param string $email
     * @return bool|array
     */
    public function retornaClienteLogin(string $email)
    {
        $query = $this->db->query(
            "SELECT
                *
            FROM
                users
            WHERE
                email = ?",
            [$email]
        );

        $query = $query->fetch(PDO::FETCH_ASSOC);

        if ($query) {
            return $query;
        }

        return false;
    }

    /**
     * Função responsável por efetuar o login
     *
     * @param string $senha
     * @param string $data
     * @return bool
     */
    public function realizaLogin(string $senha, array $data)
    {
        if (password_verify($senha, $data['senha'])) {
            unset($data['senha']);

            $_SESSION['user'] = $data;

            return true;
        } else {
            return false;
        }
    }
}
