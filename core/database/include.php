<?php
$configs = parse_ini_file(WPATH . "core/configs_lb.ini");
require "Database.php";
Database::setUp(array(
    'dsn' => 'mysql:host=' . $configs["host_name"] . ';dbname=' . $configs["db_name"] . ';',
    'username' => $configs["db_user"],
    'password' => $configs["db_password"]
));

//require "Database.php";
//Database::setUp(array(
//    'dsn' => 'mysql:host=localhost;dbname=staqpesa;',
//    'username' => 'root',
//    'password' => ''
//));