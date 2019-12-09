<?php

namespace model\manager;

use model\Company;
use model\Association;
use model\manager\SectorManager;

require_once "./model/pdo.php";
require_once "./model/manager/companyManager.php";
require_once "./model/manager/associationManager.php";
require_once "./model/manager/sectorManager.php";

class StructureManager
{

    /**
     * @param int $id
     * @return $structure
     */
    public static function getFromId(int $id)
    {
        try {
            $pdo = initiateConnection();

            $stmt = $pdo->prepare("SELECT * FROM structure WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            $sectors = SectorManager::getAllThoseOfStructure($row['ID']);

            $structure = null;
            if ($row['ESTASSO']) {
                $structure = new Association($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_DONATEURS'], $sectors);
            } else {
                $structure = new Company($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], $row['NB_ACTIONNAIRES'], $sectors);
            }

            return $structure;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    /**
     * @return array $structure
     */
    public static function getAll()
    {
        try {
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
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public static function save($entity)
    {
        if ($entity->getId() != null) {
            return (new StructureManager)->update($entity);
        } else {
            return (new StructureManager)->create($entity);
        }
    }

    private function update($entity)
    {
        try {
            $pdo = initiateConnection();

            // First, let's update the entity
            $stmt = $pdo->prepare("
                UPDATE structure 
                    SET NOM=:name, RUE=:street, CP=:postalCode, VILLE=:cityName,
                        ESTASSO=:isAssociation, NB_DONATEURS=:donatorNumber, NB_ACTIONNAIRES=:shareholderNumber
                    WHERE ID = :id
                ");

            $stmt->bindValue(':id', $entity->getId());
            $stmt->bindValue(':name', $entity->getName());
            $stmt->bindValue(':street', $entity->getStreetName());
            $stmt->bindValue(':postalCode', $entity->getPostalCode());
            $stmt->bindValue(':cityName', $entity->getCityName());
            $stmt->bindValue(':isAssociation', $entity instanceof Association ? 1 : 0);

            if ($entity instanceof Association) {
                $stmt->bindValue(':donatorNumber', $entity->getDonorNumber());
                $stmt->bindValue(':shareholderNumber', null);
            } else {
                $stmt->bindValue(':donatorNumber', null);
                $stmt->bindValue(':shareholderNumber', $entity->getShareholderNumber());
            }

            $stmt->execute();

            // Then delete all joins to the sector.
            $stmt = $pdo->prepare("DELETE FROM secteurs_structures WHERE ID_STRUCTURE = :id");
            $stmt->bindValue(":id", $entity->getId());
            $stmt->execute();

            // Finally, link back the new sector.
            $stmt = $pdo->prepare("
                INSERT INTO secteurs_structures (ID_STRUCTURE, ID_SECTEUR) VALUES (:id_structure, :id_sector)
                ");

            foreach ($entity->getSectors() as $sector) {
                $stmt->bindValue(':id_sector', $sector->getId());
                $stmt->bindValue(':id_structure', $entity->getId());

                $stmt->execute();
            }


            return $entity;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    private function create($entity)
    {
        try {
            $pdo = initiateConnection();

            // First, let's insert the entity
            $stmt = $pdo->prepare("
                INSERT INTO structure 
                    (NOM, RUE, CP, VILLE, ESTASSO, NB_DONATEURS, NB_ACTIONNAIRES) 
                    VALUES
                    (:name, :street, :postalCode, :cityName, :isAssociation, :donatorNumber, :shareholderNumber)
                ");

            $stmt->bindValue(':name', $entity->getName());
            $stmt->bindValue(':street', $entity->getStreetName());
            $stmt->bindValue(':postalCode', $entity->getPostalCode());
            $stmt->bindValue(':cityName', $entity->getCityName());
            $stmt->bindValue(':isAssociation', $entity instanceof Association ? 1 : 0);

            if ($entity instanceof Association) {
                $stmt->bindValue(':donatorNumber', $entity->getDonorNumber());
                $stmt->bindValue(':shareholderNumber', null);
            } else {
                $stmt->bindValue(':donatorNumber', null);
                $stmt->bindValue(':shareholderNumber', $entity->getShareholderNumber());
            }

            $stmt->execute();

            $id = $pdo->lastInsertId();

            // Then, link the sector to this freshly created entity.
            $stmt = $pdo->prepare("
                INSERT INTO secteurs_structures (ID_STRUCTURE, ID_SECTEUR) VALUES (:id_structure, :id_sector)
                ");

            foreach ($entity->getSectors() as $sector) {
                $stmt->bindValue(':id_sector', $sector->getId());
                $stmt->bindValue(':id_structure', $id);

                $stmt->execute();
            }


            return $id;
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }

    public static function delete(int $id)
    {
        try {
            $pdo = initiateConnection();

            // First, let's delete the joins (sectors).
            $stmt = $pdo->prepare("DELETE FROM secteurs_structures WHERE ID_STRUCTURE = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();

            // Then, delete the entity.
            $stmt = $pdo->prepare("DELETE FROM structure WHERE ID = :id");
            $stmt->bindValue(":id", $id);
            $stmt->execute();
        } catch (\Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}
