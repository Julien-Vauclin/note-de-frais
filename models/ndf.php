<?php
class ExpenseClaim
{
    private string $date;
    private string $reason;
    private string $proof;
    private string $ValidationDate;
    private string $ReasonOfCancel;
    private string $IdEmployee;
    private string $IdStatus;
    private string $IdExpenseClaimType;

    public static function getInfosExpenseClaim(string $IdEmployee)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM expenses_claim WHERE IdEmployee = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$IdEmployee]);

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
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
