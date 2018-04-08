<?php
/**
 * Class QuoteModuleFuneral
 * @package App\RootAPI\Models
 */

namespace RootAPI\Models;

class QuoteModuleFuneral
{
    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var boolean $hasSpouse
     */
    protected $hasSpouse;

    /**
     * @var integer $numberOfChildren
     */
    protected $numberOfChildren;

    /**
     * @var array $extendedFamilyAges
     */
    protected $extendedFamilyAges = [];

    /**
     * QuoteModuleFuneral constructor.
     * @param null $type
     * @param null $hasSpouse
     * @param null $numberOfChildren
     * @param array $extendedFamilyAges
     */
    public function __construct($type = null, $hasSpouse = null, $numberOfChildren = null, $extendedFamilyAges = [])
    {
        $this->setType($type);
        $this->setHasSpouse($hasSpouse);
        $this->setNumberOfChildren($numberOfChildren);
        $this->setExtendedFamilyAges($extendedFamilyAges);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return boolean
     */
    public function getHasSpouse()
    {
        return $this->hasSpouse;
    }

    /**
     * @param boolean $hasSpouse
     */
    public function setHasSpouse($hasSpouse)
    {
        $this->hasSpouse = $hasSpouse;
    }

    /**
     * @return integer
     */
    public function getNumberOfChildren()
    {
        return $this->numberOfChildren;
    }

    /**
     * @param integer $numberOfChildren
     */
    public function setNumberOfChildren($numberOfChildren)
    {
        $this->numberOfChildren = $numberOfChildren;
    }

    /**
     * @return array
     */
    public function getExtendedFamilyAges()
    {
        return $this->extendedFamilyAges;
    }

    /**
     * @param $extendedFamilyAges
     */
    public function setExtendedFamilyAges($extendedFamilyAges)
    {
        $this->extendedFamilyAges = $extendedFamilyAges;
    }
}