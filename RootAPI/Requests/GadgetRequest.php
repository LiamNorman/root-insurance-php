<?php
/**
 * Class GadgetRequest
 * Wrapper class that handles GadgetRequest requests relating to fetching model data
 * @package App\RootAPI\Requests
 */

namespace RootAPI\Requests;

use RootAPI\Client;
use RootAPI\Models\InsuranceGadget;

class GadgetRequest
{
    public function getGadgetModels()
    {
        $client = new Client('insurance/modules/root_gadgets/models', 'GET');
        $gadgets = $client->doRequest();

        $insuranceGadgets = [];
        foreach ($gadgets as $gadget) {
            $insuranceGadgets[] = new InsuranceGadget($gadget->make, $gadget->name, $gadget->value);
        }

        return $insuranceGadgets;
    }
}