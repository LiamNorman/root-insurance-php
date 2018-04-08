<?php
/**
 * Class QuoteRequest
 * Wrapper class that handles quote requests
 * @package App\RootAPI\Requests
 */

namespace RootAPI\Requests;

use RootAPI\Client;
use RootAPI\Constants;
use RootAPI\Exceptions\InvalidQuoteTypeException;
use RootAPI\Models\InsuranceGadget;
use RootAPI\Models\QuoteModuleFuneral;
use RootAPI\Models\QuotePackage;

class QuoteRequest
{
    public function postGadgetQuote(InsuranceGadget $gadget = null)
    {
        if (empty($gadget)) {
            throw new \Exception('Null gadget used for quote request');
        }

        $client = new Client('insurance/quotes', 'POST', [
            'type' => Constants::QUOTE_TYPE_ROOT_GADGETS,
            'model_name' => $gadget->getName(),
        ]);
        $quotes = $client->doRequest();

        return $this->getQuotePackages($quotes, Constants::QUOTE_TYPE_ROOT_GADGETS);
    }

    public function postFuneralCoverQuote($coverAmount = null, $hasSpouse = null, $numberofChildren = null, $extendedFamilyAges = [])
    {
        $client = new Client('insurance/quotes', 'POST', [
            'type' => Constants::QUOTE_TYPE_ROOT_FUNERAL,
            'cover_amount' => $coverAmount,
            'has_spouse' => $hasSpouse,
            'number_of_children' => $numberofChildren,
            'extended_family_ages' => $extendedFamilyAges
        ]);
        $quotes = $client->doRequest();

        return $this->getQuotePackages($quotes, Constants::QUOTE_TYPE_ROOT_FUNERAL);
    }

    private function getQuoteModule(\Closure $quoteModuleFunction)
    {
        return $quoteModuleFunction();
    }

    private function getQuotePackages($quotes, $quoteType)
    {
        $quotePackages = [];
        foreach ($quotes as $quote) {
            $quoteModuleData = $quote->module;
            $quoteModule = $this->getQuoteModule(function () use ($quoteModuleData, $quoteType) {
                switch ($quoteType) {
                    case Constants::QUOTE_TYPE_ROOT_GADGETS:
                        return new InsuranceGadget($quoteModuleData->type, $quoteModuleData->make, $quoteModuleData->model);
                    case Constants::QUOTE_TYPE_ROOT_FUNERAL:
                        return new QuoteModuleFuneral($quoteModuleData->type, $quoteModuleData->has_spouse, $quoteModuleData->number_of_children, $quoteModuleData->extended_family_ages);
                    case Constants::QUOTE_TYPE_ROOT_LIFE:
                        /**
                         * TODO: add closure
                         */
                        break;
                    default:
                        throw new InvalidQuoteTypeException('Invalid QuoteRequest Type for QuoteRequest Request');
                }
            });

            $quotePackage = new QuotePackage(
                $quote->quote_package_id,
                $quote->package_name,
                $quote->sum_assured,
                $quote->base_premium,
                $quote->suggested_premium,
                $quoteModule
            );

            $quotePackages[] = $quotePackage;
        }

        return $quotePackages;
    }
}