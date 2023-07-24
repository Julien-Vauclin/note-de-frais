<?php
class Employee
{
    private string $lastname;
    private string $firstname;
    private string $mail;
    private string $phone;
    private string $password;

    public static function getInfosEmployee(string $mail)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM employee WHERE mail = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$mail]);

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
            // On affiche un message si l'adresse mail est vide
            elseif (empty($mail)) {
                echo "Veuillez renseigner votre adresse mail.";
                return false;
            } else {
                // Aucun résultat trouvé pour l'adresse e-mail
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des informations de l'employé : " . $exception->getMessage();
            return false;
        }
    }
}
