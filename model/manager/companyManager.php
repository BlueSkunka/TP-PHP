<?php

namespace model\manager;

use model\Company;

require_once "./model/pdo.php";
require_once "./model/Company.php";

class CompanyManager
{

    /**
     * @param int $id
     * @return Company $company
     */
    public static function getFromId(int $id)
    {
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("SELECT * FROM structure WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $company = new Company($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], 0, $row['NB_ACTIONNAIRES']);

        return $company;
    }

    /**
     * @return array $companies
     */
    public static function getAll()
    {
        $pdo = initiateConnection();

        $req = "SELECT ID FROM structure WHERE ESTASSO = 0 ORDER BY NOM";
        $stmt = $pdo->query($req);

        $companies = [];

        while ($row = $stmt->fetch()) {
            $company = CompanyManager::getFromId($row['ID']);
            $companies[] = $company;
        }

        return $companies;
    }
}
