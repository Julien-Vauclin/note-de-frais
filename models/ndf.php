<?php
class ExpenseClaim
{
    private string $Date;
    private string $Price;
    private string $Reason;
    private string $Proof;
    private string $Validation_date;
    private string $Reason_of_cancel;
    private string $ID_EMPLOYEE;
    private string $ID_STATUS;
    private string $ID_EXPENSES_CLAIM_TYPE;

    public static function getInfosExpenseClaim(string $ID_EMPLOYEE)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "INSERT INTO `expenses_claim` (`Date`, `Price`, `Reason`, `Proof`,`ID_EXPENSES_CLAIM_TYPE`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$ID_EMPLOYEE]);

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                // Aucun résulta trouvé
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des informations de l'employé : " . $exception->getMessage();
            return false;
        }
    }
}
