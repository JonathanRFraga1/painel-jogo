<?php

require_once 'vendor/autoload.php';

use App\Classes\Database;

$database = new Database();

$query = $database->query("SELECT * FROM users");

var_dump($query);
