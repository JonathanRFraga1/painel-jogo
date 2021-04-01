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
//         "nickname" => "teste",
//         "email" => "aaaaa@gmail.com",
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

// $query = $database->delete("users", "id", "2");

// var_dump($query);

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);

    $file = './App/controllers/' . $url[0] . '-controller.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        require_once './404.php';
    }
} else {
    require_once './App/controllers/home-controller.php';
}
