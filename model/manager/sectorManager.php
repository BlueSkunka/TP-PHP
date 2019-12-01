<?php

namespace model\manager;

use model\Sector;

require_once "./model/pdo.php";
require_once "./model/Sector.php";

class SectorManager
{

    /**
     * @param int $id
     * @return Sector $sector
     */
    public static function getFromId(int $id)
    {
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("SELECT * FROM sector WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $sector = new Sector($row['LIBELLE']);

        return $sector;
    }

    /**
     * @return array $sectors
     */
    public static function getAll()
    {
        $pdo = initiateConnection();

        $req = "SELECT S.LIBELLE FROM secteur S";
        $stmt = $pdo->query($req);

        $sectors = [];

        while ($row = $stmt->fetch()) {
            $sector = $row;
            $sectors[] = $sector;
        }

        return $sectors;
    }
}
