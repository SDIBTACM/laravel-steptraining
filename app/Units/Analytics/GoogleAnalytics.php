<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-19 19:01
 */

namespace App\Units\Analytics;


use App\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class GoogleAnalytics
{
    private $client;

    private $GA;

    public function __construct()
    {
        $this->GA = env('GA_KEY', 'UA-123456-1');
        $this->client = new Client(['base_url' => 'https://www.google-analytics.com/']);
    }

    static public function sent(CollectedData $data) {
        $handle = new self();

        $promise = $handle->client->requestAsync('POST', "https://www.google-analytics.com/collect", [
           'form_params' => [
               'tid' => $handle->GA,
               'cid' => $data->clientId,
               'uid' => $data->userId,
               'uip' => $data->ip,
               'ua' => $data->ua,
               'ul' => $data->language,
               'dr' => $data->refer,
               'dl' => $data->link,
               'sr' => $data->screen,
           ],
        ]);

        $promise->then(
            function (RequestException $e) {
                Log::warning('Google Analytics Status: {}', $e->getMessage());
            }
        );

    }
}