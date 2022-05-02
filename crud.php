<?php

/*
*
* C REATE
* R EAD
* U PADATE
* D ELETE
*
*/

$db = new PDO('mysql:host=localhost;dbname=crud', 'root', '');


// Datenbank erstellen
//CREATE DATABASE crud

//Tabelle erstellen
/*
$sql = "CREATE TABLE users (
            id INTEGER PRIMARY KEY NOT NULL auto_increment,
            firstname VARCHAR(25),
            lastname VARCHAR(25)
        );";
$db->exec($sql);
*7


/*******
 * CREATE
 */

// Variante 1
/*
$sql = "INSERT INTO users (firstname, lastname) VALUES ('Tim', 'Tester');";
$sql .= "INSERT INTO users (firstname, lastname) VALUES ('Tina', 'Tester');";
$db->exec($sql);
*/

// Variante 2
/* 
$sql = "INSERT INTO users (firstname, lastname)
        VALUES (:fn, :ln);";
$stmt = $db->prepare($sql);
$fn = 'Tom';
$ln = 'Tester';
$stmt->bindParam(":fn", $fn);
$stmt->bindParam(":ln", $ln);
$stmt->execute();
*/

//Variante 3
/*
$sql = "INSERT INTO users (firstname, lastname)
        VALUES (firstname = ?, lastname = ?);";
$stmt = $db->prepare($sql);
$stmt->execute(['Tina', 'Tester']);
*/

/*******
 * READ
 */

$sql = "SELECT * FROM users";
$stmt = $db->query($sql);

/* 
$data = $stmt->fetch();
echo "<pre>";
var_dump($data);
echo "</pre>";
*/

/*
$data = $stmt->fetchAll();
echo "<pre>";
var_dump($data);
echo "</pre>";
*/

/*******
 * UPDATE
 */

/*
$sql = "UPDATE users
        SET firstname = 'Tim'
        WHERE id = 2;";
$stmt = $db->query($sql);
$stmt->exec();
*/

/*
$sql = "UPDATE users
        SET firstname=?
        WHERE id = ?";

$stmt = $db->prepare($sql);
$stmt->execute(['Tamara', 3]);
*/

/*
$sql = "UPDATE users
        SET firstname = :fn
        WHERE id = :id";
$stmt = $db->prepare($sql);
$id = 3;
$name = 'Tanja';
$stmt->bindParam(":id", $id);
$stmt->bindParam(":fn", $name);
$stmt->execute();
*/



/*******
 * DELETE
 */

$sql = "DELETE FROM users
WHERE id = ?";

$stmt = $db->prepare($sql);
$stmt->execute([3]);


