<?php
/**
 * Class ApplicationRequest
 * Wrapper class that handles API requests relating to Applications
 * @package App\RootAPI\Requests
 */

namespace RootAPI\Requests;

use RootAPI\Client;


class ApplicationRequest
{
    public function createApplication($quotePackageId, $policyHolderId, $monthlyPremium)
    {
        try {
            $client = new Client('insurance/applications', 'POST', [
                'monthly_premium' => $monthlyPremium,
                'serial_number' => '1234567890',
                'quote_package_id' => $quotePackageId,
                'policyholder_id' => $policyHolderId,
            ]);

            $application = $client->doRequest();

            // issue policy
            $client = new Client('insurance/policies', 'POST', [
                'application_id' => $application->application_id,
            ]);

            $client->doRequest();

            return true;
        } catch (\Exception $e) {
            $this->say('Failed to create ApplicationRequest');
            return false;
        }
    }
}