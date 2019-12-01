<?php

namespace model;

class Sector
{
    private $_id;
    private $_label;

    /**
     * Structure constructor.
     * @param int $id
     * @param string $label
     */
    public function __construct(int $id, string $label)
    {
        $this->_id = $id;
        $this->_label = $label;
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

}