<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../controllers/controller-login-employe.php');
    exit();
}
include "../views/creation-ndf.php";
