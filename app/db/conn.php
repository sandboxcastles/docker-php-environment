<?php
    $host = "mysql";
    $db = "tutorial";
    $username = "tutorial";
    $pw = "secret";

    $dbString = "mysql:dbname=$db;host=$host";
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    try {
        $pdo = new PDO($dbString, $username, $pw, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>