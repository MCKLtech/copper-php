<?php

namespace Copper;

use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\UriFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use stdClass;
use Thinkific\ThinkificUsers;

class CopperClient
{
    /**
     * @var HttpClient $httpClient
     */
    public $httpClient;

    /**
     * @var RequestFactory $requestFactory
     */
    public $requestFactory;

    /**
     * @var UriFactory $uriFactory
     */
    public $uriFactory;

    /**
     * @var string API Key / Token
     */
    public $apiToken;

    /**
     * @var string User Email
     */
    public $email;

    /**
     * @var string Copper API Version
     */
    private $version;

    /**
     * @var CopperAccounts
     */
    public $account;

    /**
     * @var CopperLeads
     */
    public $leads;

    /**
     * @var CopperPeople
     */
    public $people;

    /**
     * @var CopperCompanies
     */
    public $companies;

    /**
     * @var CopperOpportunities
     */
    public $opportunities;

    /**
     * @var CopperProjects
     */
    public $projects;

    /**
     * @var CopperTasks
     */
    public $tasks;

    /**
     * @var CopperActivities
     */
    public $activities;

    /**
     * @var CopperCustomActivities
     */
    public $customActivities;

    /**
     * @var CopperCustomFieldDefinition
     */
    public $customFieldDefinition;

    /**
     * @var CopperRelatedItems
     */
    public $relatedItems;

    /**
     * @var array $extraRequestHeaders
     */
    private $extraRequestHeaders;

    /**
     * @var array $rateLimitDetails
     */
    protected $rateLimitDetails = [];

    const COPPER_API_URL = 'https://api.copper.com/developer_api';

    /**
     * CopperClient constructor.
     *
     * @param string $apiToken App Token.
     * @param string $domain Domain
     * @param array $extraRequestHeaders Extra request headers to be sent in every api request
     * @param int $version API Version in use
     * @param bool $oauth Set true if using OAuth token instead of API key
     */
    public function __construct(string $apiToken, string $email, array $extraRequestHeaders = [], $version = 1, $oauth = false)
    {

        $this->account = new CopperAccounts($this);
        $this->leads = new CopperLeads($this);
        $this->people = new CopperPeople($this);
        $this->companies = new CopperCompanies($this);
        $this->opportunities = new CopperOpportunities($this);
        $this->projects = new CopperProjects($this);
        $this->tasks = new CopperTasks($this);
        $this->activities = new CopperActivities($this);
        $this->customActivities = new CopperCustomActivities($this);
        $this->customFieldDefinition = new CopperCustomFieldDefinition($this);

        $this->relatedItems = new CopperRelatedItems($this);

        $this->apiToken = $apiToken;
        $this->email = $email;
        $this->extraRequestHeaders = $extraRequestHeaders;
        $this->version = $version;

        $this->httpClient = $this->getDefaultHttpClient();
        $this->requestFactory = MessageFactoryDiscovery::find();
        $this->uriFactory = UriFactoryDiscovery::find();

    }

    /**
     * Sets the HTTP client.
     *
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Sets the request factory.
     *
     * @param RequestFactory $requestFactory
     */
    public function setRequestFactory(RequestFactory $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * Sets the URI factory.
     *
     * @param UriFactory $uriFactory
     */
    public function setUriFactory(UriFactory $uriFactory)
    {
        $this->uriFactory = $uriFactory;
    }

    /**
     * Determines if a response has more pages
     *
     * @param stdClass $response
     * @return bool
     */
    public function hasMore(stdClass $response)
    {

        if (isset($response->meta->pagination)) {

            return $response->meta->pagination->current_page < $response->meta->pagination->next_page;
        }

        return false;
    }

    /**
     * Returns the next page number of a response
     *
     * @param string $path
     * @param stdClass $response
     * @return int
     * @throws ClientExceptionInterface
     */
    public function nextPage(stdClass $response)
    {

        return isset($response->meta->pagination->next_page) ? $response->meta->pagination->next_page : 1;

    }

    /**
     * Sends POST request to Copper API.
     *
     * @param string $endpoint
     * @param array $json
     * @return stdClass
     */
    public function post($endpoint, $json)
    {
        $response = $this->sendRequest('POST', self::COPPER_API_URL . "/v$this->version/$endpoint", $json);
        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Copper API.
     *
     * @param string $endpoint
     * @param array $json
     * @return stdClass
     */
    public function put($endpoint, $json)
    {
        $response = $this->sendRequest('PUT', self::COPPER_API_URL . "/v$this->version/$endpoint", $json);
        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Copper API.
     *
     * @param string $endpoint
     * @param array $json
     * @return stdClass
     */
    public function delete($endpoint, $json = [])
    {
        $response = $this->sendRequest('DELETE', self::COPPER_API_URL . "/v$this->version/$endpoint", $json);
        return $this->handleResponse($response);
    }

    /**
     * Sends GET request to Copper API.
     *
     * @param string $endpoint
     * @param array $queryParams
     * @return stdClass
     */
    public function get($endpoint, $queryParams = [])
    {

        $uri = $this->uriFactory->createUri(self::COPPER_API_URL . "/v$this->version/$endpoint");

        if (!empty($queryParams)) {
            $uri = $uri->withQuery(http_build_query($queryParams));
        }

        $response = $this->sendRequest('GET', $uri);

        return $this->handleResponse($response);
    }

    /**
     * Gets the rate limit details.
     *
     * @return array
     */
    public function getRateLimitDetails()
    {
        return $this->rateLimitDetails;
    }

    /**
     * @return HttpClient
     */
    private function getDefaultHttpClient()
    {
        return new PluginClient(
            HttpClientDiscovery::find(),
            [new ErrorPlugin()]
        );
    }

    /**
     * @return array
     */
    private function getRequestHeaders()
    {
        return array_merge(
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            $this->extraRequestHeaders
        );
    }

    /**
     * @return array
     */
    private function getRequestAuthHeaders()
    {
        return [
            'X-PW-AccessToken' => $this->apiToken,
            'X-PW-Application' => 'developer_api',
            'X-PW-UserEmail' => $this->email
        ];

    }

    /**
     * @param string $method
     * @param string|UriInterface $uri
     * @param array|string|null $body
     *
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    private function sendRequest($method, $uri, $body = null)
    {
        $headers = $this->getRequestHeaders();

        $authHeaders = $this->getRequestAuthHeaders();

        $headers = array_merge($headers, $authHeaders);

        $body = is_array($body) ? json_encode($body) : $body;

        $request = $this->requestFactory->createRequest($method, $uri, $headers, $body);

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return stdClass
     */
    public function handleResponse(ResponseInterface $response)
    {
        $this->setRateLimitDetails($response);

        $stream = $response->getBody()->getContents();

        return json_decode($stream);
    }

    /**
     * @param ResponseInterface $response
     */
    private function setRateLimitDetails(ResponseInterface $response)
    {
        $this->rateLimitDetails = [
            'reset_at' => $response->hasHeader('RateLimit-Reset')
                ? (int)$response->getHeader('RateLimit-Reset')
                : null,
        ];
    }


}
