<?php

namespace model;

class Structure
{
    protected $_id;
    protected $_name;
    protected $_streetName;
    protected $_postalCode;
    protected $_cityName;
    protected $_sector;

    /**
     * Structure constructor.
     * @param int|null $id
     * @param string $_name
     * @param string $_streetName
     * @param int $_postalCode
     * @param string $_cityName
     * @param Sector|null $sector
     */
    public function __construct(int $id = null, string $_name, string $_streetName, int $_postalCode, string $_cityName, Sector $sector = null)
    {
        $this->_id = $id;
        $this->_name = $_name;
        $this->_streetName = $_streetName;
        $this->_postalCode = $_postalCode;
        $this->_cityName = $_cityName;
        $this->_sector = $sector;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getStreetName()
    {
        return $this->_streetName;
    }

    /**
     * @param mixed $streetName
     */
    public function setStreetName(string $streetName)
    {
        $this->_streetName = $streetName;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->_postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode(string $postalCode)
    {
        $this->_postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->_cityName;
    }

    /**
     * @param mixed $cityName
     */
    public function setCityName(string $cityName)
    {
        $this->_cityName = $cityName;
    }

    /**
     * @return string $adresse
     */
    public function getAdresse()
    {
        $adresse = "";
        $adresse += $this->_streetName + " ";
        $adresse += $this->_postalCode + " ";
        $adresse += $this->_cityName;

        return $adresse;
    }

    /**
     * @return Sector|null
     */
    public function getSector()
    {
        return $this->_sector;
    }

    /**
     * @param Sector $sector
     */
    public function setSector(Sector $sector)
    {
        $this->_sector = $sector;
    }
}
