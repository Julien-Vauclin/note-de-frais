<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../controllers/controller-login-employe.php');
    exit();
}
if (isset($_POST['deleteID'])) {
    echo "La note" . " " . $_POST['deleteID'] . " " . "de l'employé" . " " . $_POST['ownerID'] . " " . "a bien été supprimée";
}
require_once "../config.php";
require_once "../helpers/Database.php";
require_once "../models/affichage-ndf.php";
include "../views/espace-employe.php";
