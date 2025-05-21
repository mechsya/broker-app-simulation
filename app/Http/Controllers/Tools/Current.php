<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Current extends Controller
{
    public static function price($slug = 'bitcoin')
    {
        $url = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest';

        $parameters = [
            'slug' => $slug,
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . env('COINCAP_MARKET_API')
        ];

        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        $r = json_decode($response, true);
        curl_close($curl); // Close request
        return $r['data'][1]['quote']['USD']['price'];
    }
}
