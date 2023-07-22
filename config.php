<?php

// Je définis les constantes de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'note-de-frais');
define('DB_USER', 'root');
define('DB_PASSWORD', '');


// try {
//     $newDB = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASSWORD);
//     echo "Connexion à la base de données établie";
// } catch (PDOException $e) {
//     die("Erreur : " . $e->getMessage());
// }
// if (
//     isset($_POST['lastname']) &&
//     isset($_POST['firstname']) &&
//     isset($_POST['mail']) &&
//     isset($_POST['phone']) &&
//     isset($_POST['password']) &&
//     isset($_POST['confirmationmotdepasse'])
// ) {
//     $insertion = $newDB->prepare("INSERT INTO employee (lastname, firstname, mail, phone, password) VALUES (:lastname, :firstname, :mail, :phone, :password)");
//     $insertion->bindValue(':lastname', $_POST['lastname']);
//     $insertion->bindValue(':firstname', $_POST['firstname']);
//     $insertion->bindValue(':mail', $_POST['mail']);
//     $insertion->bindValue(':phone', $_POST['phone']);
//     $insertion->bindValue(':password', $_POST['password']);
//     $verification =  $insertion->execute();
//     if ($verification) {
//         echo "L'employé a bien été ajouté";
//     } else {
//         echo "Erreur lors de l'ajout de l'employé";
//     }
// } else {
//     echo "Erreur lors de l'ajout de l'employé, une valeur doit être manquante.";
// }
