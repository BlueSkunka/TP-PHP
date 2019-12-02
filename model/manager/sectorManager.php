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

        $stmt = $pdo->prepare("SELECT * FROM secteur WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $sector = new Sector($row['ID'], $row['LIBELLE']);

        return $sector;
    }

    /**
     * @return Sector[] $sectors
     */
    public static function getAll()
    {
        $pdo = initiateConnection();

        $req = "SELECT * FROM secteur S";
        $stmt = $pdo->query($req);

        $sectors = [];

        while ($row = $stmt->fetch()) {
            $sector = new Sector($row['ID'], $row['LIBELLE']);
            $sectors[] = $sector;
        }

        return $sectors;
    }

    public static function getAllWithExtraInformations() {
        $pdo = initiateConnection();

        $req = "SELECT DISTINCT S.*, SC.ID AS IS_DELETABLE FROM secteur S LEFT JOIN secteurs_structures SC ON (SC.ID_SECTEUR = S.ID)
            GROUP BY S.ID, S.LIBELLE, SC.ID";
        $stmt = $pdo->query($req);

        $sectors = [];

        while ($row = $stmt->fetch()) {
            $sector = new Sector($row['ID'], $row['LIBELLE'], $row['IS_DELETABLE']? false: true);
            $sectors[] = $sector;
        }

        return $sectors;
    }

    public static function delete(int $id) {
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("DELETE FROM secteur WHERE ID = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    public static function save(Sector $sector) {
        if ($sector->getId() != null) {
            return (new SectorManager)->update($sector);
        } else {
            return (new SectorManager)->create($sector);
        }
    }

    private function create(Sector $sector) {
        $pdo = initiateConnection();

        // Insert the sector
        $stmt = $pdo->prepare("
            INSERT INTO secteur (ID, LIBELLE) VALUES (:id, :label)
        ");

        $stmt->bindValue(':id', $sector->getId());
        $stmt->bindValue(':label', $sector->getLabel());

        $stmt->execute();

        $id = $pdo->lastInsertId();

        return $id;
    }

    private function update(Sector $sector) {
        $pdo = initiateConnection();

        // Update the sector
        $stmt = $pdo->prepare("
            UPDATE secteur SET LIBELLE=:label WHERE ID=:id
        ");

        $stmt->bindValue(':id', $sector->getId());
        $stmt->bindValue(':label', $sector->getLabel());

        $stmt->execute();

        $id = $pdo->lastInsertId();

        return $id;
    }
}
