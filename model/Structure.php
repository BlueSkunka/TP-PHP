<?php

namespace model;

class Structure
{
    protected $_id;
    protected $_name;
    protected $_streetName;
    protected $_postalCode;
    protected $_cityName;

    /**
     * Structure constructor.
     * @param int $_id 
     * @param string $_name
     * @param string $_streetName
     * @param int $_postalCode
     * @param string $_cityName
     */
    public function __construct(int $id, string $_name, string $_streetName, int $_postalCode, string $_cityName)
    {
        $this->_id = $id;
        $this->_name = $_name;
        $this->_streetName = $_streetName;
        $this->_postalCode = $_postalCode;
        $this->_cityName = $_cityName;
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

    static public function getFromId(int $id)
    {
        include_once "pdo.php";
        $pdo = initiateConnection();
        $stmt = $pdo->prepare("SELECT * FROM structure WHERE id = ?");
        $stmt->execute([$id]);
        $arr = $stmt->fetch();

        return $arr;
    }
}
