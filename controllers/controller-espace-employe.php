<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../controllers/controller-login-employe.php');
    exit();
}
include "../views/espace-employe.php";
require_once "../config.php";
require_once "../helpers/Database.php";
