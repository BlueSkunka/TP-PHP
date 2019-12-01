<?php

namespace model;

require_once "Structure.php";

class Company extends Structure
{
    private $_shareholderNumber;

    /**
     * Company constructor.
     * @param int $_id 
     * @param string $_name
     * @param string $_streetName
     * @param int $_postalCode
     * @param string $_cityName
     * @param $_shareholderNumber
     */
    public function __construct(int $id, string $name, string $streetName, int $postalCode, string $cityName, int $_shareholderNumber)
    {
        parent::__construct($id, $name, $streetName, $postalCode, $cityName);
        $this->_shareholderNumber = $_shareholderNumber;
    }

    /**
     * @return int
     */
    public function getShareholderNumber(): int
    {
        return $this->_shareholderNumber;
    }

    /**
     * @param int $shareholderNumber
     */
    public function setShareholderNumber(int $shareholderNumber)
    {
        $this->_shareholderNumber = $shareholderNumber;
    }

    /**
     * @return string $adresse
     */
    public function getAdresse()
    {
        return parent::getAdresse();
    }
}
