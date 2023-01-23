<?php $user = 'root';
    $pass = 'root';
    $dbhost = 'mysql';
    $database = 'mydatabase';

    $conn = new PDO("mysql:host=$dbhost;database=$database", $user, $pass);
