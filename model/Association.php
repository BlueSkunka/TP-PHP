<?php

class Association
{
    private $_id;
    private $_isAssociation = 1;
    private $_donorNumber;

    /**
     * Association constructor.
     * @param int $_id
     * @param int $_isAssociation
     * @param int $_donorNumber
     */
    public function __construct(int $_isAssociation, int $_donorNumber)
    {
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
}