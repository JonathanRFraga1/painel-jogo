<?php

namespace App\Classes;

use PDO;

class Database
{
    private $hostname;
    private $dbtype;
    private $dbname;
    private $user;
    private $pass;
    private $connection;

    public function __construct()
    {
        $this->hostname = DB_HOST;
        $this->dbtype = DB_TYPE;
        $this->dbname = DB_NAME;
        $this->user = DB_USER;
        $this->pass = DB_PASS;

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
    public function insert(string $table, array $params)
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

        return $execute;
    }

    /**
     * Função responsavel por executar consultas no BD
     *
     * @param string $query_string
     * @param array $params
     * @return object
     */
    public function query(string $query_string, array $params = [])
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
    public function update(string $table, string $field_where, string $value_were, array $params)
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
    public function delete(string $table, string $where_field, string $where_value)
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where_field . " = :" . $where_field;

        $query = $this->connection->prepare($sql);

        $query->bindParam(':' . $where_field, $where_value);

        return $query->execute();
    }
}
