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

    public static function createExpenseClaim(string $ID_EMPLOYEE)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "INSERT INTO `expenses_claim` (`Date`, `Price`, `Reason`, `Proof`,`ID_EXPENSES_CLAIM_TYPE`, `ID_EMPLOYEE`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);


            // Vérifier s'il y a des résultats
            if ($stmt->execute([$ID_EMPLOYEE])) {
                return true;
            } else {
                // Aucun résultat trouvé
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des informations de l'employé : " . $exception->getMessage();
            return false;
        }
    }
    // Delete
    public static function deleteExpenseClaim(string $ID)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "DELETE FROM `expenses_claim` WHERE `ID` = ?";
            $stmt = $pdo->prepare($sql);

            // Vérifier s'il y a des résultats
            if ($stmt->execute([$ID])) {
                return true;
            } else {
                // Aucun résultat trouvé
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur" . $exception->getMessage();
            return false;
        }
    }
}
