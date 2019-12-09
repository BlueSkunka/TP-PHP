<?php

namespace model\manager;

use model\Company;
use model\Sector;
use model\manager\SectorManager;

require_once "./model/pdo.php";
require_once "./model/Company.php";
require_once "./model/Sector.php";
require_once "./model/manager/sectorManager.php";

class CompanyManager
{

    /**
     * @param int $id
     * @return Company $company
     */
    public static function getFromId(int $id)
    {
        try {
            $pdo = initiateConnection();

            $req = "SELECT * FROM structure WHERE id = ?";
            $stmt = $pdo->prepare($req);

            $stmt->execute([$id]);
            $row = $stmt->fetch();

            $sectors = SectorManager::getAllThoseOfStructure($row['ID']);

            $company = new Company($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_ACTIONNAIRES'], $sectors);

            return $company;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @return Company[] $companies
     */
    public static function getAll()
    {
        try {
            $pdo = initiateConnection();

            $req = "SELECT ID FROM structure WHERE ESTASSO = 0 ORDER BY NOM";
            $stmt = $pdo->query($req);

            $companies = [];

            while ($row = $stmt->fetch()) {
                $company = CompanyManager::getFromId($row['ID']);
                $companies[] = $company;
            }
            return $companies;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}
