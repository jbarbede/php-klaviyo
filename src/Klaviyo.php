<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class KlaviyoException extends Exception
{
}

class Klaviyo
{
    protected $api_key;
    protected $token;
    protected $version;
    protected $base_url = "https://a.klaviyo.com/api/";
    protected $TRACK_ONCE_KEY = '__track_once__';
    protected $client;

    public function __construct($api_key = null, $token = null, $version = 1)
    {
        $this->api_key = $api_key;
        $this->token = $token;
        $this->version = $version;
        $this->client = new Client([
            'base_uri' => $this->base_url,
            'connect_timeout' => 10,
            'read_timeout' => 10,
            'timeout' => 10
        ]);
    }

    /**
     * @param string $url
     * @param array $params
     * @return bool|mixed|ResponseInterface
     * @throws KlaviyoException
     * @throws GuzzleException
     */
    public function get($url = "", $params = [])
    {
        return $this->go("GET", $url, $params);
    }

    /**
     * @param $url
     * @param array $params
     * @return bool|mixed|ResponseInterface
     * @throws KlaviyoException
     * @throws GuzzleException
     */
    public function post($url, $params = [])
    {
        return $this->go("POST", $url, $params);
    }

    /**
     * @param $url
     * @param array $params
     * @return bool|mixed|ResponseInterface
     * @throws KlaviyoException
     * @throws GuzzleException
     */
    public function put($url, $params = [])
    {
        return $this->go("PUT", $url, $params);
    }

    /**
     * @param $url
     * @param array $params
     * @return bool|mixed|ResponseInterface
     * @throws KlaviyoException
     * @throws GuzzleException
     */
    public function delete($url, $params = [])
    {
        return $this->go("DELETE", $url, $params);
    }

    /**
     * @param $method
     * @param $url
     * @param $params
     * @return bool|mixed|ResponseInterface
     * @throws KlaviyoException
     * @throws GuzzleException
     */
    public function go($method, $url, $params = [])
    {
        //Version Override for Lists API
        if (isset($params['version'])) {
            $this->version = $params['version'];
            unset($params['version']);
        } else {
            $this->version = 1;
        }
        //The track and identify calls are TECHNICALLY GET requests. This allows them to be called in that manner.
        if ($method == "GET" && strpos($url, "track_once") === 0) {
            if (!isset($params['properties'])) $params['properties'] = null;
            if (!isset($params['time'])) $params['time'] = null;
            return $this->track_once($params['event'], $params['customer_properties'], $params['properties'], $params['time']);
        }
        if ($method == "GET" && strpos($url, "track") === 0) {
            if (!isset($params['properties'])) $params['properties'] = null;
            if (!isset($params['time'])) $params['time'] = null;
            return $this->track($params['event'], $params['customer_properties'], $params['properties'], $params['time']);
        }
        if ($method == "GET" && strpos($url, "identify") === 0) {
            return $this->identify($params);
        }

        if (!is_array($params)) {
            $params = [];
        }
        if (empty($url)) {
            throw new KlaviyoException("Please enter a destination url");
        }
        if (empty($this->api_key)) {
            throw new KlaviyoException("You must specify an API key for this request");
        }

        $url = "v" . $this->version . "/" . $url;
        $headers = $this->getHeaders();
        $params['api_key'] = $this->api_key;

        //GET and PUT Override
        if (($method == "GET" || $method == "PUT") && $this->version !== 2 && $params !== null) {
            $url .= (strpos($url, "?") === false ? "?" : "") . http_build_query($params);
            $params = [];
        }

        if ($this->version !== 2 && $params) {
            $params = http_build_query($params);
        } else {
            $headers = [
                "api-key" => $this->api_key,
                "Content-Type" => "application/json"
            ];
        }

        $options = ['headers' => $headers];
        if (!empty($params)) {
            $options['json'] = $params;
        }
        $response = $this->client->request($method, $url, $options);

        //Send To Klaviyo and Parse Response
        $json = json_decode($response->getBody()->getContents(), true);

        if (!is_array($json)) {
            return $response;
        }

        return $json;
    }

    /**
     * @return array
     */
    private function getHeaders()
    {
        if ($this->version !== 2) {
            return [
                "api-key" => $this->api_key,
            ];
        } else {
            return [
                "api-key" => $this->api_key,
                "Content-Type" => 'application/json',
            ];
        }
    }

    /**
     * @param $event
     * @param array $customer_properties
     * @param array $properties
     * @param null $timestamp
     * @return bool
     * @throws KlaviyoException
     */
    public function track($event, $customer_properties = [], $properties = [], $timestamp = NULL)
    {
        if ((!array_key_exists('$email', $customer_properties) || empty($customer_properties['$email']))
            && (!array_key_exists('$id', $customer_properties) || empty($customer_properties['$id']))) {

            throw new KlaviyoException('You must identify a user by email or ID.');
        }
        $params = array(
            'event' => $event,
            'properties' => $properties,
            'customer_properties' => $customer_properties
        );
        if (!is_null($timestamp)) {
            $params['time'] = $timestamp;
        }
        $encoded_params = $this->build_params($params);
        return $this->make_request('track', $encoded_params);
    }

    /**
     * @param $event
     * @param array $customer_properties
     * @param array $properties
     * @param null $timestamp
     * @return bool
     * @throws KlaviyoException
     */
    public function track_once($event, $customer_properties = [], $properties = [], $timestamp = NULL)
    {
        $properties[$this->TRACK_ONCE_KEY] = true;
        return $this->track($event, $customer_properties, $properties, $timestamp);
    }

    /**
     * @param $properties
     * @return bool
     * @throws KlaviyoException
     */
    public function identify($properties)
    {
        if ((!array_key_exists('$email', $properties) || empty($properties['$email']))
            && (!array_key_exists('$id', $properties) || empty($properties['$id']))) {

            throw new KlaviyoException('You must identify a user by email or ID.');
        }
        $params = array(
            'properties' => $properties
        );
        $encoded_params = $this->build_params($params);
        return $this->make_request('identify', $encoded_params);
    }

    /**
     * @param $params
     * @return string
     */
    protected function build_params($params)
    {
        $params['token'] = $this->token;
        return 'data=' . urlencode(base64_encode(json_encode($params)));
    }

    /**
     * @param $path
     * @param $params
     * @return bool
     */
    protected function make_request($path, $params)
    {
        $url = $path . '?' . $params;
        $response = $this->client->get($url);
        return (int)$response->getBody()->getContents() == 1;
    }
}
