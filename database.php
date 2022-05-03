<?php

$host = "localhost";
$db = "auth";
$name = "root";
$pwd = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$db", $name, $pwd);
} catch (PDOException $e) {
    die($e->getMessage());
}