<?php

namespace model;

require_once "Structure.php";


class Association extends Structure
{
    private $_donorNumber;

    /**
     * Association constructor.
     * @param int $_id
     * @param string $_name
     * @param string $_streetName
     * @param int $_postalCode
     * @param string $_cityName
     * @param int $_donorNumber
     */
    public function __construct(int $id, string $name, string $streetName, int $postalCode, string $cityName, int $_donorNumber)
    {
        parent::__construct($id, $name, $streetName, $postalCode, $cityName);
        $this->_donorNumber = $_donorNumber;
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
