<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-08 20:34
 */

namespace App\Crawler\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SimpleClient
{
    static public function get($url) {
        $handle = new self();
        $handle->request($url, 'GET');

        if($handle->response) {
            return $handle->response->getBody();
        } else {
            return null;
        }
    }

    static public function post($url, $paramArray) {
        $handle = new self();
        $handle->request($url, 'POST', $paramArray);

        if($handle->response) {
            return $handle->response->getBody();
        } else {
            return null;
        }
    }

    private $client;

    private $response;

    private function __construct()
    {
        $this->client = new Client();
    }

    private function request($url, $method, $paramArray = []) {

        $setting = $this->set();

        try {
            $this->response = $this->client->request($method, $url, array_merge($setting, ['form_params' => $paramArray]));
        } catch (GuzzleException $e) {
            $this->response = false;
        }
    }


    private function set() {
        return array(
            'connect_timeout' => $this->setTimeout(), // Client time out
            'headers' => [
                'User-Agent' => $this->setHeader(),
            ],
        );
    }

    private function setTimeout() {
        return 15;
    }

    private function setHeader() {
        return 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36';
    }



}