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
        try {
            $pdo = initiateConnection();

            $stmt = $pdo->prepare("SELECT * FROM secteur WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            $sector = new Sector($row['ID'], $row['LIBELLE']);

            return $sector;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @return Sector[] $sectors
     */
    public static function getAll()
    {
        try {
            $pdo = initiateConnection();

            $req = "SELECT * FROM secteur S";
            $stmt = $pdo->query($req);

            $sectors = [];

            while ($row = $stmt->fetch()) {
                $sector = new Sector($row['ID'], $row['LIBELLE']);
                $sectors[] = $sector;
            }

            return $sectors;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public static function getAllWithExtraInformations()
    {
        try {
            $pdo = initiateConnection();

            $req = "SELECT DISTINCT S.ID, S.LIBELLE, COUNT(SC.ID) AS IS_DELETABLE FROM secteur S LEFT JOIN secteurs_structures SC ON (SC.ID_SECTEUR = S.ID)
                GROUP BY S.ID;";

            $stmt = $pdo->query($req);

            $sectors = [];
            while ($row = $stmt->fetch()) {
                $sector = new Sector($row['ID'], $row['LIBELLE'], $row['IS_DELETABLE'] != 0 ? false : true);
                $sectors[] = $sector;
            }

            return $sectors;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public static function delete(int $id)
    {
        try {
            $pdo = initiateConnection();

            $stmt = $pdo->prepare("DELETE FROM secteur WHERE ID = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public static function save(Sector $sector)
    {
        if ($sector->getId() != null) {
            return (new SectorManager)->update($sector);
        } else {
            return (new SectorManager)->create($sector);
        }
    }

    private function create(Sector $sector)
    {
        try {
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
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    private function update(Sector $sector)
    {
        try {
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
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public function getAllThoseOfStructure(int $structureId)
    {
        try {
            $pdo = initiateConnection();

            // * Retun all sector of a structure
            $req = "SELECT S.ID FROM secteur S
                JOIN secteurs_structures SS ON SS.ID_SECTEUR = S.ID
                WHERE SS.ID_STRUCTURE = :structureId;";

            $stmt = $pdo->prepare($req);
            $stmt->bindValue(':structureId', $structureId);
            $stmt->execute();

            $sectors = [];
            while ($row = $stmt->fetch()) {
                $sectors[] = SectorManager::getFromId($row['ID']);
            }

            return $sectors;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}
