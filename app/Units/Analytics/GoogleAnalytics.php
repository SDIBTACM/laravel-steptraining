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

class GoogleAnalytics
{
    private $client;

    private $GA;

    public function __construct()
    {
        $this->GA = env('GA_KEY', '');
        $this->client = new Client(['base_url' => 'https://www.google-analytics.com/']);
    }

    static public function sent(CollectedData $data) {

        $handle = new self();
        Log::debug('1');

        if($handle->GA != '') {

            $response = $handle->client->request('POST', "https://www.google-analytics.com/collect", [
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

            if ($response->getStatusCode() != 200) {
                Log::warning('Google Analytics sent fail! message: {}', $response->getBody());
            }
        }

    }
}