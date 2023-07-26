<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../controllers/controller-login-employe.php');
    exit();
}
include "../views/espace-employe.php";
echo "Bienvenue " . $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'] . " !";
