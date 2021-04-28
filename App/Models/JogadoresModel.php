<?php

namespace App\Models;

use PDO;
use App\Classes\Database;
use Throwable;

class JogadoresModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Função responsável pelo retorno de todos os jogadores
     *
     * @return array|bool
     */
    public function retornaJogadores()
    {
        $query = $this->db->query("SELECT * FROM players");

        $query = $query->fetchAll(PDO::FETCH_ASSOC);

        return $query;
    }

    /**
     * Função responsável por retornar os usuários conforme um parâmentro
     *
     * @param string $string
     * @return array|bool
     */
    public function retornaJogadoresString($string)
    {
        $string = '%' . $string . '%';
        $query = $this->db->query(
            "SELECT
                *
            FROM
                players
            WHERE
                nickname LIKE ?
                OR login LIKE ?",
            [$string, $string]
        );

        $query = $query->fetchAll(PDO::FETCH_ASSOC);

        return $query;
    }

    /**
     * Função responsável pela insersão de novos jogadores no banco de dados
     *
     * @param array $values
     * @return string
     */
    public function insereJogador($values)
    {
        if (!isset($values['login']) || $values['login'] == '') {
            return 'E-mail não enviado';
        }

        if (!isset($values['senha']) || $values['senha'] == '') {
            return 'Senha não enviada';
        }

        if (!isset($values['nickname']) || $values['nickname'] == '') {
            return 'Nickname não enviado';
        }

        $senha = password_hash($values['senha'], PASSWORD_DEFAULT);

        try {
            $query = $this->db->insert(
                'players',
                [
                'nickname' => $values['nickname'],
                'login' => $values['login'],
                'senha' => $senha
                ]
            );
        } catch (Throwable $th) {
            return 'Erro ao cadastrar o jogador';
        }
        return 'sucesso';
    }
}
