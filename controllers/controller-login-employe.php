<?php require "../config.php"; ?>
<?php require "../helpers/Database.php"; ?>
<?php require "../models/User.php"; ?>
<?php var_dump($_POST); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['mail']) && isset($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $result = Employee::getInfosEmployee($mail);
        var_dump($result);
    }
    if ($result) {
        // L'adresse e-mail a été trouvée dans la base de données, affichez les informations de l'employé
        var_dump($result);
    } else {
        // L'adresse e-mail n'a pas été trouvée dans la base de données, affichez un message d'erreur
        echo "Adresse e-mail inexistante.";
    }
}
?>
<?php include "../views/login-employe.php"; ?>