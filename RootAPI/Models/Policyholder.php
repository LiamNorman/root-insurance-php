<?php
/**
 * Class PolicyholderRequest
 * @package App\RootAPI\Models
 */

namespace RootAPI\Models;

class Policyholder
{
    /**
     * @var integer $policyHolderId
     */
    protected $policyHolderId;

    /**
     * @var string $email
     */
    protected $email;

    /**
     * @var string $cellphone
     */
    protected $cellphone;

    /**
     * @var string $dateOfBirth
     */
    protected $dateOfBirth;

    /**
     * @var array $policyIds
     */
    protected $policyIds = [];

    /**
     * @var string $firstName
     */
    protected $firstName;

    /**
     * @var string $lastName
     */
    protected $lastName;

    /**
     * @var array $appData
     */
    protected $appData = [];

    /**
     * PolicyholderRequest constructor.
     * @param $firstName
     * @param $lastName
     */
    public function __construct($firstName = "", $lastName = "")
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
    }

    /**
     * @return int
     */
    public function getPolicyHolderId()
    {
        return $this->policyHolderId;
    }

    /**
     * @param $policyHolderId
     */
    public function setPolicyHolderId($policyHolderId)
    {
        $this->policyHolderId = $policyHolderId;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * @param $cellphone
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }

    /**
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return array
     */
    public function getPolicyIds()
    {
        return $this->policyIds;
    }

    /**
     * @param $policyIds
     */
    public function setPolicyIds($policyIds)
    {
        $this->policyIds = $policyIds;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            /**
             * TODO: remove fixed
             */
            'id' => [
                'type' => 'id',
                'number' => '2401015800087',
                'country' => 'ZA',
            ]
        ];
    }
}