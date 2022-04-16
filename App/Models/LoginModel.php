<?php

namespace App\Models;

use App\Abstracts\AbstractModel;
use PDO;

class LoginModel extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Função responsável por retornar o usuário no banco de dados
     *
     * @param string $email
     * @return bool|array
     */
    public function retornaUsuarioLogin(string $email): bool|array
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
     * @param array $data
     * @return bool
     */
    public function realizaLogin(string $senha, array $data): bool
    {
        if (password_verify($senha, $data['senha'])) {
            unset($data['senha']);

            $_SESSION['user'] = $data;

            return true;
        } else {
            return false;
        }
    }

    public function realizaLogout()
    {
        unset($_SESSION['user']);
        $this->redirect(HOME_URI . '/login');
    }
}
