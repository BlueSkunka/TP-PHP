<?php

namespace projet\model;

class Company
{
    private $_isAssociation = 0;
    private $_shareholderNumber;

    /**
     * Company constructor.
     * @param int $_isAssociation
     * @param $_shareholderNumber
     */
    public function __construct(int $_isAssociation, int $_shareholderNumber)
    {
        $this->_isAssociation = $_isAssociation;
        $this->_shareholderNumber = $_shareholderNumber;
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


}