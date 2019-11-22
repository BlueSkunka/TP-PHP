<?php

namespace model\manager;

use model\Association;

require_once "./model/pdo.php";
require_once "./model/Association.php";

class AssociationManager
{

    /**
     * @param int $id
     * @return Assocation $association
     */
    public static function getFromId(int $id)
    {
        $pdo = initiateConnection();

        $stmt = $pdo->prepare("SELECT * FROM structure WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        $association = new Association($row['ID'], $row['NOM'], $row['RUE'], $row['CP'], $row['VILLE'], 1, $row['NB_DONATEURS']);

        return $association;
    }

    /**
     * @return array $associations
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
}
