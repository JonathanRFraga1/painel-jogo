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
    public $connection;

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
     * Função responsavel por executar consultas no BD
     *
     * @param string $query_string
     * @param array $params
     * @return void
     */
    public function query(string $query_string, array $params = null)
    {
        $query = $this->connection->prepare($query_string);

        if (count($params) > 0) {
            for ($i = 1; $i == count($params); $i++) {
                $query->bindParam($i, $params[$i]);
            }
        }

        $query->execute();
        var_dump($query);
    }
}
