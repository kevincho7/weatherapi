<?php

namespace App\Repositories;

use App\Repositories\Interfaces\HttpClientRepositoryInterface;
use Cache;

class HttpClientRepository implements HttpClientRepositoryInterface
{
    public function get_xml($url, $zip)
    {
        // Check if there is a cached data
        if( Cache::has($zip) ) {
            return Cache::get($zip);
        }

        $client = new \GuzzleHttp\Client();
        $client_response = $client->get($url);

        $xml = $client_response->getBody()->getContents();

        // Parse the xml data
        $usable_response = simplexml_load_string($xml);

        $pluck_data = [
            'wind_speed' => (string)$usable_response->wind->speed['value'],
            'wind_direction' => (string)$usable_response->wind->direction['name']
        ];

        // Cache the result into a cached data with the key name of the zipcode for 15 minutes.
        Cache::put($zip, $pluck_data, 15);

        return $pluck_data;
    }
}