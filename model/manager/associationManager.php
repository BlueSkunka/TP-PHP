<?php

namespace model\manager;

use model\Association;
use model\Sector;

require_once "./model/pdo.php";
require_once "./model/Association.php";
require_once "./model/Sector.php";

class AssociationManager
{
    /**
     * @param int $id
     * @return Association
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
            $association = new Association($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_DONATEURS'], $sectors);

            return $association;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @return Association[] $associations
     */
    public static function getAll()
    {
        try {
            $pdo = initiateConnection();

            $req = "SELECT ID FROM structure WHERE ESTASSO = 1 ORDER BY NOM";
            $stmt = $pdo->query($req);

            $associations = [];

            while ($row = $stmt->fetch()) {
                $association = AssociationManager::getFromId(intval($row['ID']));
                $associations[] = $association;
            }

            return $associations;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}
