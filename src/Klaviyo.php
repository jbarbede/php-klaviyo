<?php

class KlaviyoException extends Exception { }

class Klaviyo
{
    protected $api_key;
    protected $token;
    protected $version;
    protected $base_url = "https://a.klaviyo.com/api/";
    protected $TRACK_ONCE_KEY = '__track_once__';
    public $last_status_code = "";

    public function __construct($api_key = null, $token = null, $version = 1) {
        $this->api_key = $api_key;
        $this->token = $token;
        $this->version = $version;
    }

    public function get($url = "", $params = null) {
        return $this->go("GET", $url, $params);
    }

    public function post($url, $params = null) {
        return $this->go("POST", $url, $params);
    }

    public function put($url, $params = null) {
        return $this->go("PUT", $url, $params);
    }

    public function delete($url, $params = null) {
        return $this->go("DELETE", $url, $params);
    }

    public function go($method, $url, $params) {
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
            $params = null;
        }
        if (!$url) {
            throw new KlaviyoException("Please enter a destination url");
        }
        if ($this->api_key == null) {
            throw new KlaviyoException("You must specify an API key for this request");
        }

        //Version Override for Lists API
        if (strpos($url, "list") === 0) {
            $url =  $this->base_url . "v" . $this->version . "/" . $url;
        }
        else {
            $url =  $this->base_url . "v1/" . $url;
        }

        $params['api_key'] = $this->api_key;

        //GET and PUT Override
        if (($method == "GET" || $method == "PUT") && $params !== null) {
            $url .= (strpos($url, "?") === false ? "?" : "") . http_build_query($params);
            $params = "";
        }

        //Setup cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        if ($params) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, urlencode(base64_encode(json_encode($params))));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);


        //Send To Klaviyo and Parse Response
        $response = trim(curl_exec($ch));
        $info = curl_getinfo($ch);
        $json = json_decode($response, 1);

        if (!is_array($json)) {
            return $response;
        }

        $this->last_status_code = $info['http_code'];
        return $json;
    }
    public function track($event, $customer_properties=array(), $properties=array(), $timestamp=NULL) {
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
            'properties' => $properties
        );
        $encoded_params = $this->build_params($params);
        return $this->make_request('identify', $encoded_params);
    }
    protected function build_params($params) {
        $params['token'] = $this->token;
        return 'data=' . urlencode(base64_encode(json_encode($params)));
    }
    protected function make_request($path, $params) {
        $url = $this->base_url . $path . '?' . $params;
        $response = file_get_contents($url);
        return $response == '1';
    }
}
