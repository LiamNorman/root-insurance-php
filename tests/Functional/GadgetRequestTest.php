<?php

namespace Tests\Feature;

use App\RootAPI\RootAPIRequest;
use Illuminate\Http\Response;
use Tests\FunctionalTestCase;

class GadgetRequestTest extends FunctionalTestCase
{

    /** @test */
    function can_fetch_gadget_models()
    {
        $rootApiRequest = new RootAPIRequest();
        $gadgets = $rootApiRequest->gadgetRequest->getGadgetModels();

        $body = file_get_contents(__DIR__ . '/../RootInsuranceMockResponses/gadget_list.json');
        $client = $this->getMockClient(Response::HTTP_OK, $body);

        $mockResponse = $client->request('GET', '/')->getBody()->getContents();
        $decodedResponse = json_decode($mockResponse, true);

        foreach ($gadgets as $index => $gadget) {
            $this->assertEquals($gadget->getMake(), $decodedResponse[$index]['make']);
            $this->assertEquals($gadget->getName(), $decodedResponse[$index]['name']);
            $this->assertEquals($gadget->getValue(), $decodedResponse[$index]['value']);
        }
    }
}