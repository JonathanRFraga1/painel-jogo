<?php

require_once 'vendor/autoload.php';

use App\Classes\Database;

$database = new Database();

// $query = $database->query(
//     "SELECT
//         *
//     FROM
//         users
//     WHERE
//         nickname = ?",
//     ['zerowin']
// );

// $query = $database->query("SELECT * FROM users");

// $query = $query->fetchAll(PDO::FETCH_ASSOC);

// print_r($query);

// $query = $database->insert(
//     "users",
//     [
//         "nickname" => "zerowin",
//         "email" => "admin@gmail.com",
//         "senha" => "1234"
//     ]
// );

// if ($query) {
//     echo "Cadastro realizado com sucesso";
// }

// $query = $database->update(
//     'users',
//     'id',
//     '1',
//     [
//         'nickname' => 'jonathan'
//     ]
// );
