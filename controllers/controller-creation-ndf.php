<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../controllers/controller-login-employe.php');
    exit();
};
require_once "../config.php";
require_once "../helpers/Database.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // On définit les variables pour stocker les valeurs des champs
    $Date = $_POST['Date'];
    $Price = $_POST['Price'];
    $Reason = $_POST['Reason'];
    $ID_EXPENSES_CLAIM_TYPE = $_POST['ID_EXPENSES_CLAIM_TYPE'];
    // On définit les variables pour stocker les messages d'erreur
    $DateError = $PriceError = $ReasonError = $ProofError = $ID_EXPENSES_CLAIM_TYPEError = "";
    // On définit les regex
    $regexDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
    $regexPrice = '/^[0-9.,]+$/';
    $regexReason = '/[a-z]/';
    $regexID_EXPENSES_CLAIM_TYPE = '/^[0-9]+$/';
    // On définit les regex pour chaque champ
    if (!preg_match($regexDate, $Date)) {
        $DateError = "La date est invalide.";
    }
    if (!preg_match($regexPrice, $Price)) {
        $PriceError = "Le prix est invalide.";
    }
    if (!preg_match($regexReason, $Reason)) {
        $ReasonError = "La raison est invalide.";
    }
    if (!preg_match($regexID_EXPENSES_CLAIM_TYPE, $ID_EXPENSES_CLAIM_TYPE)) {
        $ID_EXPENSES_CLAIM_TYPEError = "L'ID du type de note de frais est invalide.";
    }
    // On fait en sorte d'enregistrer les images de "proof" en base64
    if ($_FILES['Proof']['error'] != 4) {
        $Proof = $_FILES['Proof'];
        $ProofName = $Proof['name'];
        $ProofTmpName = $Proof['tmp_name'];
        $ProofSize = $Proof['size'];
        $ProofExtension = pathinfo($ProofName, PATHINFO_EXTENSION);
        $ProofNewName = uniqid() . '.' . $ProofExtension;
        $ProofDestination = '../uploads/' . $ProofNewName;
        $Proof = base64_encode(file_get_contents($ProofTmpName));
    } else {
        $ProofError = "Champ obligatoire.";
    }
    // Si toutes les validations réussissent, on peut insérer les données dans la base de données
    if ($DateError === "" && $PriceError === "" && $ReasonError === "" && $ProofError === "" && $ID_EXPENSES_CLAIM_TYPEError === "") {
        try {
            $db = new Database();
            $pdo = $db->createInstancePDO();
            // Requête SQL pour insérer les données dans la table "expenses_claim"
            $sql = "INSERT INTO `expenses_claim` (`Date`, `Price`, `Reason`, `Proof`, `ID_EXPENSES_CLAIM_TYPE`, `ID_EMPLOYEE`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$Date, $Price, $Reason, $Proof, $ID_EXPENSES_CLAIM_TYPE, $_SESSION['user']['ID']]);
            // Alert pour prévenir l'utilisateur que la note de frais a bien été ajoutée
            echo "<script>alert(\"La note de frais a bien été ajoutée.\")</script>;
            <script>window.location.href = \"../controllers/controller-espace-employe.php\"</script>";
        } catch (PDOException $exception) {
            echo "Erreur lors de l'ajout de la note de frais : " . $exception->getMessage() . "<br>";
        };
    } else {
        echo "FAIL !";
    }
};

// On inclut la vue
include "../views/creation-ndf.php";
