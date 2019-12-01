<?php

namespace model;

class Sector
{
    private $_label;

    /**
     * Structure constructor.
     * @param string $label
     */
    public function __construct(string $label)
    {
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

}