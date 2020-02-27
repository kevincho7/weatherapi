<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\HttpClientRepositoryInterface;
use Cache;

class WeatherController extends Controller
{
    private $HttpClientRepository;

    private function validate_data($data)
    {
        if (preg_match('/\b\d{5}\b/', $data)) {
            return true;
        }

        return false;
    }

    public function __construct(HttpClientRepositoryInterface $HttpClientRepository)
    {
        $this->HttpClientRepository = $HttpClientRepository;
    }

    public function index($zip)
    {
        // Validate the data
        if (!$this->validate_data($zip)) {
            return response()->json(['error' => 'You must provide a valid US zip code in your API query.'], 400);
        }

        $app_id = config("weather.app_id");
        $url = "https://api.openweathermap.org/data/2.5/weather?zip=$zip,us&appid=$app_id&mode=xml";

        $response_data = $this->HttpClientRepository->get_xml($url, $zip);

        return response()->json($response_data, 200);
    }
}
