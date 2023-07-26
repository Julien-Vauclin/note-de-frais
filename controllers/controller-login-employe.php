<?php require "../config.php"; ?>
<?php require "../helpers/Database.php"; ?>
<?php require "../models/User.php"; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mail']) && isset($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $result = Employee::getInfosEmployee($mail);
        var_dump($result);
        //On vérifie si l'utilisateur existe dans la base de données
        if ($result == false) {
            echo "L'utilisateur n'existe pas. (controller-login-employe.php)";
        } else {
            var_dump($password);
            //On vérifie si le mot de passe est correct
            if (password_verify($password, $result['password'])) {
                //On démarre la session
                session_start();
                //On enregistre le nom d'utilisateur dans la session
                $_SESSION['user'] = $result;
                unset($_SESSION['user']['password']);
                //On redirige vers la page d'accueil
                header('Location: ../controllers/controller-espace-employe.php');
                exit();
            } else {
                echo "Le mot de passe est incorrect. (controller-login-employe.php)";
            }
        }
    }
}
?>
<?php include "../views/login-employe.php"; ?>