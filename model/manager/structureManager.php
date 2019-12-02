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

    public static function save($entity) {

        $pdo = initiateConnection();

        // First, let's insert the entity
        $stmt = $pdo->prepare("
            INSERT INTO structure 
                (NOM, RUE, CP, VILLE, ESTASSO, NB_DONATEURS, NB_ACTIONNAIRES) 
                VALUES
                (:name, :street, :postalCode, :cityName, :isAssociation, :donatorNumber, NULL)
        ");

        $stmt->bindValue(':name', $entity->getName());
        $stmt->bindValue(':street', $entity->getStreetName());
        $stmt->bindValue(':postalCode', $entity->getPostalCode());
        $stmt->bindValue(':cityName', $entity->getCityName());
        $stmt->bindValue(':isAssociation', $entity instanceof Association? 1: 0);
        $stmt->bindValue(':donatorNumber', $entity->getDonorNumber());

        $stmt->execute();

        $id = $pdo->lastInsertId();

/*        // Then, link the sector to this freshly created entity.
        $stmt = $pdo->prepare("
            INSERT INTO secteurs_structures (ID_STRUCTURE, ID_SECTEUR) VALUES (:id_structure, :id_sector)
        ");

        $stmt->bindValue(':id_sector', $entity->getSector()->getId());
        $stmt->bindValue(':id_structure', $id);*/

        $stmt->execute();

        return $id;
    }

    public static function delete(int $id) {
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("DELETE FROM structure WHERE ID = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }
}
