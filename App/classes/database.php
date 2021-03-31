<?php

namespace App\Classes;

use PDO;

class Database
{
    private string $hostname;
    private string $dbtype;
    private string $dbname;
    private string $user;
    private string $pass;
    private $connection;

    public function __construct()
    {
        $this->hostname = "localhost:8000";
        $this->dbtype = "mysql";
        $this->dbname = "forca";
        $this->user = "root";
        $this->pass = "";

        $dsn = $this->dbtype . ':hostname=' . $this->hostname . ';dbname=' . $this->dbname;

        $this->connection = new PDO($dsn, $this->user, $this->pass);
    }

    /**
     * Função responsavel por inserir dados no banco
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
                $sql .= ":" . $fields_array[$i] . ', ';
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
}
