<?php

namespace model;

require_once "Structure.php";


class Association extends Structure
{
    private $_isAssociation = 1;
    private $_donorNumber;

    /**
     * Association constructor.
     * @param int $_id
     * @param string $_name
     * @param string $_streetName
     * @param int $_postalCode
     * @param string $_cityName
     * @param int $_isAssociation
     * @param int $_donorNumber
     */
    public function __construct(int $id, string $name, string $streetName, string $postalCode, string $cityName, int $_isAssociation, int $_donorNumber)
    {
        parent($id, $name, $streetName, $postalCode, $cityName);
        $this->_isAssociation = $_isAssociation;
        $this->_donorNumber = $_donorNumber;
    }

    /**
     * @return int
     */
    public function getIsAssociation(): int
    {
        return $this->_isAssociation;
    }

    /**
     * @param int $isAssociation
     */
    public function setIsAssociation(int $isAssociation)
    {
        $this->_isAssociation = $isAssociation;
    }

    /**
     * @return mixed
     */
    public function getDonorNumber()
    {
        return $this->_donorNumber;
    }

    /**
     * @param mixed $donorNumber
     */
    public function setDonorNumber(int $donorNumber)
    {
        $this->_donorNumber = $donorNumber;
    }

    /**
     * @return array $associations
     */
    public static function getAll()
    {
        require_once "pdo.php";
        $pdo = initiateConnection();

        $req = "SELECT ID FROM structure WHERE ESTASSO = 1 ORDER BY NOM";
        $stmt = $pdo->query($req);

        $associations = [];

        while ($row = $stmt->fetch()) {
            $association = Structure::getFromId($row['ID']);
            $associations[] = $association;
        }

        return $associations;
    }
}
