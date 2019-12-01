<?php

namespace model\manager;

use model\Company;
use model\Association;

require_once "./model/pdo.php";
require_once "./model/manager/companyManager.php";
require_once "./model/manager/associationManager.php";

class StructureManager
{

    /**
     * @param int $id
     * @return $structure
     */
    public static function getFromId(int $id)
    {
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("SELECT * FROM structure WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $structure = null;
        if ($row['ESTASSO']) {
            $structure = new Association($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_DONATEURS']);
        } else {
            $structure = new Company($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_ACTIONNAIRES']);
        }

        return $structure;
    }

    /**
     * @return array $structure
     */
    public static function getAll()
    {
        $pdo = initiateConnection();

        $req = "SELECT ID FROM structure ORDER BY NOM";
        $stmt = $pdo->query($req);

        $structures = [];

        while ($row = $stmt->fetch()) {
            $structure = null;
            if ($row['ESTASSO']) {
                $structure = AssociationManager::getFromId($row['ID']);
            } else {
                $structure = CompanyManager::getFromId($row['ID']);
            }

            $structures[] = $structure;
        }

        return $structures;
    }
}
