<?php
require_once "../config.php";
require_once "../models/User.php";
require_once "../helpers/Database.php";
// Variables pour stocker les valeurs des champs
$lastname = $firstname = $mail = $phone = $password = "";
// Variables pour stocker les messages d'erreur
$lastnameError = $firstnameError = $mailError = $phoneError = $passwordError = "";
// Variable pour stocker le niveau de sécurité du mot de passe
$securityLevel = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $motDePasse = $_POST['password'];
    $confirmationMotDePasse = $_POST['confirmationmotdepasse'];
    // Définition des regex
    $regexLastname = '/^[a-zA-Z]+$/';
    $regexFirstname = '/^[a-zA-Z]+$/';
    $regexMail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/';
    $regexPhone = '/^(06|07)\d{8}$/';

    // Validation des regex pour chaque champ
    if (!preg_match($regexLastname, $lastname)) {
        $lastnameError = "Le nom est invalide.";
    }

    if (!preg_match($regexFirstname, $firstname)) {
        $firstnameError = "Le prénom est invalide.";
    }

    if (!preg_match($regexMail, $mail)) {
        $mailError = "L'adresse mail est invalide.";
    }

    if (!preg_match($regexPhone, $phone)) {
        $phoneError = "Le numéro de téléphone est invalide.";
    }

    if ($password !== $confirmationMotDePasse) {
        $passwordError = "Les mots de passe ne correspondent pas.";
    }

    // Si toutes les validations réussissent, on peut insérer les données dans la base de données
    if ($lastnameError === "" && $firstnameError === "" && $mailError === "" && $phoneError === "" && $passwordError === "" && $password === $confirmationMotDePasse && $securityLevel >= 2) {
        try {
            $db = new Database();
            $pdo = $db->createInstancePDO();
            // Requête SQL pour insérer les données dans la table "employee"
            $sql = "INSERT INTO employee (lastname, firstname, mail, phone, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nomInscrit, $prenomInscrit, $mailInscrit, $numeroTelephone, $motDePasse]);
            echo "L'employé a bien été ajouté. (inscription.php)";
        } catch (PDOException $exception) {
            echo "Erreur lors de l'ajout de l'employé : " . $exception->getMessage() . "<br>";
        }
    }
}
include "../views/inscription.php";
