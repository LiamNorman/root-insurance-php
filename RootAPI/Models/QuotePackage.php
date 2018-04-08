<?php
/**
 * Class QuotePackage
 * @package App\RootAPI\Models
 */

namespace RootAPI\Models;

class QuotePackage
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var integer $sumAssured
     */
    protected $sumAssured;

    /**
     * @var integer $basePremium
     */
    protected $basePremium;

    /**
     * @var integer $suggestedPremium
     */
    protected $suggestedPremium;

    /**
     * @var mixed $module
     * module is the object that you are generating a quote on namely InsuranceGadget
     */
    protected $module;

    /**
     * QuotePackage constructor.
     * @param $id
     * @param $name
     * @param $sumAssured
     * @param $basePremium
     * @param $suggestedPremium
     * @param $module
     */
    public function __construct($id = "", $name = "", $sumAssured = null, $basePremium = null, $suggestedPremium = null, $module = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setSumAssured($sumAssured);
        $this->setBasePremium($basePremium);
        $this->setSuggestedPremium($suggestedPremium);
        $this->setModule($module);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSumAssured()
    {
        return $this->sumAssured;
    }

    /**
     * @param mixed $sumAssured
     */
    public function setSumAssured($sumAssured)
    {
        $this->sumAssured = $sumAssured;
    }

    /**
     * @return mixed
     */
    public function getBasePremium()
    {
        return $this->basePremium;
    }

    /**
     * @param mixed $basePremium
     */
    public function setBasePremium($basePremium)
    {
        $this->basePremium = $basePremium;
    }

    /**
     * @return mixed
     */
    public function getSuggestedPremium()
    {
        return $this->suggestedPremium;
    }

    /**
     * @param mixed $suggestedPremium
     */
    public function setSuggestedPremium($suggestedPremium)
    {
        $this->suggestedPremium = $suggestedPremium;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }
}