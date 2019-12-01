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
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("SELECT STR.*, SEC.ID AS SEC_ID, SEC.LIBELLE FROM structure STR 
                JOIN secteurs_structures SC
                    ON (SC.ID_STRUCTURE = STR.ID)
                JOIN secteur SEC
                    ON (SEC.ID = SC.ID_SECTEUR)
                WHERE STR.id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $sector = null;
        if ($row['SEC_ID']) {
            $sector = new Sector($row['SEC_ID'], $row['LIBELLE']);
        }

        $association = new Association($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_DONATEURS'], $sector);

        return $association;
    }

    /**
     * @return Association[] $associations
     */
    public static function getAll()
    {
        $pdo = initiateConnection();

        $req = "SELECT ID FROM structure WHERE ESTASSO = 1 ORDER BY NOM";
        $stmt = $pdo->query($req);

        $associations = [];

        while ($row = $stmt->fetch()) {
            $association = AssociationManager::getFromId($row['ID']);
            $associations[] = $association;
        }

        return $associations;
    }

    public static function save(Association $association) {
        // If there is no id, save should create an entry in the database.
        if ($association->getId() == null) {
            return self::create($association);
        }
        return self::update($association);
    }

    public static function create(Association $association) {
        $pdo = initiateConnection();

        // First, let's insert the association entity
        $stmt = $pdo->prepare("
            INSERT INTO structure 
                (NOM, RUE, CP, VILLE, ESTASSO, NB_DONATEURS, NB_ACTIONNAIRES) 
                VALUES
                (:name, :street, :postalCode, :cityName, 1, :donatorNumber, NULL)
        ");

        $stmt->bindValue(':name', $association->getName());
        $stmt->bindValue(':street', $association->getStreetName());
        $stmt->bindValue(':postalCode', $association->getPostalCode());
        $stmt->bindValue(':cityName', $association->getCityName());
        $stmt->bindValue(':donatorNumber', $association->getDonorNumber());

        $stmt->execute();

        $id = $pdo->lastInsertId();

        // Then, link the sector to this freshly created entity.
        $stmt = $pdo->prepare("
            INSERT INTO secteurs_structures (ID_STRUCTURE, ID_SECTEUR) VALUES (:id_structure, :id_sector)
        ");

        $stmt->bindValue(':id_sector', $association->getSector()->getId());
        $stmt->bindValue(':id_structure', $id);

        $stmt->execute();
    }

    public static function update(Association $association) {

    }
}
