<?php

namespace Klaviyo;

use GuzzleHttp\Client;

class KlaviyoException extends Exception { }

class Klaviyo
{
    protected $api_key;
    protected $client;
    public function __construct($api_key, Client $client = null)
    {
        $this->api_key = $api_key;
        if (!is_null($client)) {
            $this->client = $client;
        } else {
            $this->client = new Client(array(
                'base_uri' => 'https://a.klaviyo.com/api/v1/'
            ));
        }
    }
    public function getApiKey()
    {
        return $this->api_key;
    }
    public function request($method, $path, array $options = array())
    {
        $response = $this->client->request($method, $path, $options);
        $body = json_decode($response->getBody()->getContents(), true);
        return $body;
    }
    public function get($path, array $params = array())
    {
        $params['api_key'] = $this->api_key;
        return $this->request('GET', $path, array(
            'query' => $params
        ));
    }
    public function post($path, array $params = array())
    {
        $params['api_key'] = $this->api_key;
        return $this->request('POST', $path, array(
            'form_params' => $params
        ));
    }
    public function put($path, array $params = array())
    {
        $params['api_key'] = $this->api_key;
        return $this->request('PUT', $path, array(
            'form_params' => $params
        ));
    }
    public function delete($path, array $params = array())
    {
        $params['api_key'] = $this->api_key;
        return $this->request('DELETE', $path, array(
            'form_params' => $params
        ));
    }
    public function track($event, $customer_properties=array(), $properties=array(), $timestamp=NULL) {
        if ((!array_key_exists('$email', $customer_properties) || empty($customer_properties['$email']))
            && (!array_key_exists('$id', $customer_properties) || empty($customer_properties['$id']))) {
            
            throw new KlaviyoException('You must identify a user by email or ID.');
        }
        $params = array(
            'token' => $this->api_key,
            'event' => $event,
            'properties' => $properties,
            'customer_properties' => $customer_properties
        );
        if (!is_null($timestamp)) {
            $params['time'] = $timestamp;
        }
        $encoded_params = $this->build_params($params);
        return $this->make_request('api/track', $encoded_params);
    }
    public function track_once($event, $customer_properties=array(), $properties=array(), $timestamp=NULL) {
        $properties[$this->TRACK_ONCE_KEY] = true;
        return $this->track($event, $customer_properties, $properties, $timestamp);
    }
    public function identify($properties) {
        if ((!array_key_exists('$email', $properties) || empty($properties['$email']))
            && (!array_key_exists('$id', $properties) || empty($properties['$id']))) {
            
            throw new KlaviyoException('You must identify a user by email or ID.');
        }
        $params = array(
            'token' => $this->api_key,
            'properties' => $properties
        );
        $encoded_params = $this->build_params($params);
        return $this->make_request('api/identify', $encoded_params);
    }
    protected function build_params($params) {
        return 'data=' . urlencode(base64_encode(json_encode($params)));
    }
    protected function make_request($path, $params) {
        $url = $this->host . $path . '?' . $params;
        $response = file_get_contents($url);
        return $response == '1';
    }
}
