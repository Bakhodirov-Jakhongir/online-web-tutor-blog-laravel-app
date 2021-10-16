<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiteController extends Controller
{

    public function create()
    {
        //URL
        $apiURL = 'https://jsonplaceholder.typicode.com/posts';

        //Post Data
        $postInput = [
            'title' => 'Something new post tille',
            'body' => 'something new post body',
            'userId' => 7
        ];

        //Headers
        $headers = [];

        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST', $apiURL, ['form_params' => $postInput, 'headers' => $headers]);

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);

        $statusCode = $response->status();

        $responseBody = json_decode($response->getBody(), true);

        return response()->json([
            'data' => [
                'status' => $statusCode,
                'response-body' => $responseBody
            ]
        ], $statusCode);
    }

    public function delete()
    {
        $deleteId = 40;
        //URL
        $apiURL = 'https://jsonplaceholder.typicode.com/posts/' . $deleteId;

        // use guzzlehttp client 
        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('DELETE', $apiURL);

        //or use Http client
        $response = Http::delete($apiURL);

        $statusCode = $response->status();

        $responseBody = json_decode($response->getBody(), true);

        echo $statusCode; // status code

        dd($responseBody); // body response
    }
}
