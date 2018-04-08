<?php
/**
 * Client base class that handles all API requests
 */

namespace RootAPI;

use RootAPI\Exceptions\BadRequestException;
use GuzzleHttp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package App\RootAPI
 */

class Client
{
    /**
     * @var string $uri
     */
    protected $uri;

    /**
     * @var string $method
     */
    protected $method;

    /**
     * @var array $parameters
     */
    protected $parameters;

    /**
     * @var string $baseUrl
     */
    protected $baseUrl;

    /**
     * Connect timeout limit of the request
     */
    const TIMEOUT_LIMIT = 20;

    /**
     * Client constructor.
     * @param string $uri
     * @param string $method
     * @param array $parameters
     * @param string $baseUrl
     */
    public function __construct($uri = "", $method = "", $parameters = [], $baseUrl = "")
    {
        $this->setBaseUrl(env('ROOT_BASE_URL', 'BASE_URL'));
        $this->setUri($uri);
        $this->setMethod($method);
        $this->setParameters($parameters);
    }

    /**
     * @return GuzzleHttp\Client
     */
    private function createClient()
    {
       return new GuzzleHttp\Client(['base_uri' => $this->getBaseUrl(), 'timeout' => self::TIMEOUT_LIMIT, 'auth' => [env('ROOT_API_KEY', 'API_KEY'), '']]);
    }

    /**
     * @return mixed|\Psr\Http\Message\StreamInterface
     * @throws BadRequestException
     */
    public function doRequest()
    {
        $client = $this->createClient();

        if (empty($this->getMethod())) {
            throw new BadRequestException('Empty method in API request');
        }

        $jsonParams = [];

        switch ($this->getMethod()) {
            case Request::METHOD_PUT:
            case Request::METHOD_POST:
                $jsonParams = ['json' => $this->getParameters()];
                break;
        }

        if (!empty($jsonParams)) {
            return $this->parseResponse($client->request($this->getMethod(), $this->getUri(), $jsonParams));
        }

        return $this->parseResponse($client->request($this->getMethod(), $this->getUri()));
    }

    /**
     * @param GuzzleHttp\Client $client
     */
    public function setAuthHeaders(GuzzleHttp\Client &$client)
    {
        $client->setDefaultOption('auth', ['username' => env('ROOT_API_KEY'), 'password' => '']);
    }

    /**
     * @param ResponseInterface $response
     * @return mixed|\Psr\Http\Message\StreamInterface
     * @throws BadRequestException
     */
    public function parseResponse(ResponseInterface $response)
    {
        if (empty($response->getStatusCode()) || $response->getStatusCode() != Response::HTTP_OK) {
            throw new BadRequestException();
        }

        $responseBody = $response->getBody();
        if ($responseBody instanceof GuzzleHttp\Psr7\Stream) {
            $responseBodyAsString = (string)$response->getBody();
            return json_decode($responseBodyAsString);
        }

        return $response->getBody();
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @throws \Exception
     */
    public function setMethod($method)
    {
        if (empty($method)) {
            return;
        }

        $validMethods = [Request::METHOD_GET, Request::METHOD_PUT, Request::METHOD_POST, Request::METHOD_DELETE];
        if (!in_array($method, $validMethods)) {
            throw new \Exception('Invalid Request Method Type');
        }

        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
}