<?php
/**
 * Class InsuranceGadget
 * @package App\RootAPI\Models
 */

namespace RootAPI\Models;

class InsuranceGadget
{
    /**
     * @var string $make
     */
    protected $make = "";

    /**
     * @var string $name
     */
    protected $name = "";

    /**
     * @var string $value
     */
    protected $value = "";

    /**
     * InsuranceGadget constructor.
     * @param string $make
     * @param string $name
     * @param string $value
     */
    public function __construct($make = "", $name = "", $value = "")
    {
        $this->setMake($make);
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @param string $make
     */
    public function setMake($make)
    {
        $this->make = $make;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return float|int
     */
    public function getValueInRands()
    {
        // to get value in rands, we simply divide by 100
        return $this->getValue() / 100;
    }
}