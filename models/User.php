<?php
class Employee
{
    private string $lastname;
    private string $firstname;
    private string $mail;
    private string $phone;
    private string $password;

    public static function getAllEmployees(): array
    {
        $pdo = Database::createInstancePDO();
        $sql = "SELECT `employee`.`id`, `employee`.`lastname`, `employee`.`firstname`, `employee`.`mail`, `employee`.`phone`, `employee`.`password` FROM `employee`";
        $pdo_statement = $pdo->query($sql);
        $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
