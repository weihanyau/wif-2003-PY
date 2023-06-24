<?php
//Q1-Write PHP and PHP data objects (PDOs) statements to connect to the MySQL database server.
$host = 'localhost';
$dbname = 'riskdb';
$username = 'manager';
$password = 'mgr123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
