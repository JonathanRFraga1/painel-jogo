<?php

namespace App\Classes;

use PDO;

/**
 * Classe Database
 * @author Jonathan Rossetto de Fraga
 * @version 1.0
 * @package App\Classes
 *
 * Classe responsável por fazer a conexão com o banco de dados
 */
class Database
{
    private string $hostname;
    private string $dbtype;
    private string $dbname;
    private string $user;
    private string $pass;
    private PDO $connection;

    /**
     * Ultimo id inserido no banco de dados
     * @var int $lastInsertId
     */
    public int $lastInsertId;

    public function __construct()
    {
        $this->hostname = DB_HOST;
        $this->dbtype = DB_TYPE;
        $this->dbname = DB_NAME;
        $this->user = DB_USER;
        $this->pass = DB_PASS;

        // DataSourceName
        $dsn = $this->dbtype . ':hostname=' . $this->hostname . ';dbname=' . $this->dbname;

        $this->connection = new PDO($dsn, $this->user, $this->pass);
    }

    /**
     * Função responsavel por inserir registros no banco de dados
     *
     * @param string $table
     * @param array $params
     * @return bool
     */
    public function insert(string $table, array $params): bool
    {
        $fields_array = array_keys($params);
        $fields = implode(', ', $fields_array);

        $sql = "INSERT INTO " . $table . " (" . $fields . ") VALUES (";

        $num_params = count($params);

        for ($i = 0; $i < $num_params; $i++) {
            if ($i != ($num_params - 1)) {
                $sql .= ':' . $fields_array[$i] . ', ';
            } else {
                $sql .= ':' . $fields_array[$i] . ');';
            }
        }

        $values = array_values($params);

        $query = $this->connection->prepare($sql);

        for ($i = 0; $i < $num_params; $i++) {
            $token = ':' . $fields_array[$i];
            $query->bindParam($token, $values[$i]);
        }

        $execute = $query->execute();

        $this->lastInsertId = $this->connection->lastInsertId();

        return $execute;
    }

    /**
     * Função responsavel por executar consultas no BD
     *
     * @param string $query_string
     * @param array $params
     * @return object
     */
    public function query(string $query_string, array $params = []): object
    {
        $query = $this->connection->prepare($query_string);

        $num_params = count($params);

        if ($num_params > 0) {
            for ($i = 1; $i <= $num_params; $i++) {
                $query->bindParam($i, $params[$i - 1]);
            }
        }

        $query->execute();

        return $query;
    }

    /**
     * Função responsavel por atualizar os registros no banco de dados
     *
     * @param string $table
     * @param string $field_where
     * @param string $value_were
     * @param array $params
     * @return bool
     */
    public function update(string $table, string $field_where, string $value_were, array $params): bool
    {
        $sql = "UPDATE " . $table . " SET ";

        $num_params = count($params);

        $fields_array = array_keys($params);

        for ($i = 0; $i < $num_params; $i++) {
            if ($i != ($num_params - 1)) {
                $sql .=  $fields_array[$i] . '= :' . $fields_array[$i] . ' , ';
            } else {
                $sql .= $fields_array[$i] . '= :' . $fields_array[$i];
            }
        }

        $sql .= ' WHERE ' . $field_where . ' = ' . $value_were;

        $values = array_values($params);

        $query = $this->connection->prepare($sql);

        for ($i = 0; $i < $num_params; $i++) {
            $token = ':' . $fields_array[$i];
            $query->bindParam($token, $values[$i]);
        }

        $query->execute();

        return $query;
    }

    /**
     * Função responsável pela exclusão de registros no banco de dados
     *
     * @param string $table
     * @param string $where_field
     * @param string $where_value
     * @return bool
     */
    public function delete(string $table, string $where_field, string $where_value): bool
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where_field . " = :" . $where_field;

        $query = $this->connection->prepare($sql);

        $query->bindParam(':' . $where_field, $where_value);

        return $query->execute();
    }
}
