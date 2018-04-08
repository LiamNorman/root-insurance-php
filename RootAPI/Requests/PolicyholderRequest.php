<?php
/***
 * Class Policy
 * Wrapper class that handles policy requests
 * @package App\RootAPI\Requests
 */

namespace RootAPI\Requests;

use RootAPI\Client;
use RootAPI\Models\Policyholder;
use Illuminate\Http\Response;

class PolicyholderRequest
{
    public function getAllPolicyHolders()
    {
        $client = new Client('insurance/policyholders', 'GET');
        $policyHolders = $client->doRequest();

        return $policyHolders;
    }

    public function getPolicyHolder($idNumber)
    {
        $client = new Client("insurance/policyholders?id_number=$idNumber", 'GET');
        $response = $client->doRequest();

        if (empty($response)) {
            $this->say("Can't find Policyholder");
        }
        /**
         * TODO: fix
        */
        // first response is always current policy holder in this case
        $policyHolderDetails = $response[0];

        return $policyHolderDetails;
    }

    public function createPolicyHolder(PolicyholderRequest $policyHolder)
    {
        try {
            $client = new Client('insurance/policyholders', 'POST', $policyHolder->toArray());
            return $client->doRequest();


        } catch (\Exception $e) {
            if ($e->getResponse()->getStatusCode() == Response::HTTP_CONFLICT) {
                return $this->getPolicyHolder(2401015800087);
            }
            $this->say('Failed to create Policy Holder');
        }
    }
}