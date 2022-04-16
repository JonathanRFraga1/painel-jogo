<?php

namespace App\Models;

use App\Abstracts\AbstractModel;
use PDO;
use Throwable;

class JogadoresModel extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Função responsável pelo retorno de todos os jogadores
     *
     * @return array|bool
     */
    public function retornaJogadores(): bool|array
    {
        $query = $this->db->query("SELECT * FROM players");

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Função responsável por retornar os usuários conforme um parâmentro
     *
     * @param string $string
     * @return array|bool
     */
    public function retornaJogadoresString(string $string): bool|array
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

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Função responsável pela insersão de novos jogadores no banco de dados
     *
     * @param array $values
     * @return string
     */
    public function insereJogador(array $values): string
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
