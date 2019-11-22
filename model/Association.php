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
    public function __construct(int $id, string $name, string $streetName, int $postalCode, string $cityName, int $_isAssociation, int $_donorNumber)
    {
        parent::__construct($id, $name, $streetName, $postalCode, $cityName);
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
     * @return string $adresse
     */
    public function getAdresse()
    {
        return parent::getAdresse();
    }
}
