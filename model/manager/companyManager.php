<?php

namespace model\manager;

use model\Company;
use model\Sector;

require_once "./model/pdo.php";
require_once "./model/Company.php";
require_once "./model/Sector.php";

class CompanyManager
{

    /**
     * @param int $id
     * @return Company $company
     */
    public static function getFromId(int $id)
    {
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("
            SELECT STR.*, SEC.ID AS SEC_ID, SEC.LIBELLE FROM structure STR 
                JOIN secteurs_structures SC
                    ON (SC.ID_STRUCTURE = STR.ID)
                JOIN secteur SEC
                    ON (SEC.ID = SC.ID_SECTEUR)
                WHERE STR.id = ?
        ");

        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $sector = null;
        if ($row['SEC_ID']) {
            $sector = new Sector($row['SEC_ID'], $row['LIBELLE']);
        }
        $company = new Company($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_ACTIONNAIRES'], $sector);

        return $company;
    }

    /**
     * @return Company[] $companies
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
