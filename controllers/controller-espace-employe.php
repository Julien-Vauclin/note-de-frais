<?php
session_start();
require_once "../config.php";
require_once "../helpers/Database.php";
require_once "../models/ndf.php";
if (!isset($_SESSION['user'])) {
    header('Location: ../controllers/controller-login-employe.php');
    exit();
}
if (isset($_POST['deleteID'])) {
    if (isset($_POST['ownerID']) && $_POST['ownerID'] == $_SESSION['user']['ID']) {
        ExpenseClaim::deleteExpenseClaim($_POST['deleteID']);
        echo "<script>alert(\"La note de frais a bien été supprimée.\")</script>";
    } else {
        echo "Vous ne pouvez pas supprimer cette note de frais";
    }
}
include "../views/espace-employe.php";
