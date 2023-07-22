<?php

class Database
{
    /**
     * Méthode qui retourne une instance de la classe PDO
     * @return objet PDO
     */
    public static function createInstancePDO(): object
    {

        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

        try {
            // création d'une instance de la classe PDO
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            echo "Connexion réussie à la base de données. (database.php)" . "<br>";
            if ($pdo) {
                return $pdo;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
