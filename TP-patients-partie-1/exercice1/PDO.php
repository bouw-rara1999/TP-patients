<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_DATABASE', 'colyseum');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

try{
    $database = new PDO('mysql:host=' .DB_HOST. ';port='  .DB_PORT.  ';dbname=' .DB_DATABASE, DB_USERNAME, DB_PASSWORD);
}
    catch (PDOException $e) {
    die('le code d\'erreur est000000 ' . $e->getCode());
}
