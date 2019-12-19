<?php

namespace model;

class Sector
{
    private $_id;
    private $_label;
    private $_isDeletable;

    /**
     * Structure constructor.
     * @param int $id
     * @param string $label
     * @param bool $isDeletable
     */
    public function __construct(int $id, string $label, bool $isDeletable = false)
    {
        $this->_id = $id;
        $this->_label = $label;
        $this->_isDeletable = $isDeletable;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel(string $label)
    {
        $this->_label = $label;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * @return bool
     */
    public function isDeletable(): bool
    {
        return $this->_isDeletable;
    }

    /**
     * @param bool $isDeletable
     */
    public function setIsDeletable(bool $isDeletable)
    {
        $this->_isDeletable = $isDeletable;
    }
}
