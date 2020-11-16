<?php

namespace App\Http\Clients;

use Illuminate\Support\Facades\Http;

class UdemyClients{
    public function getUdemyCourses(){

        $client = Http::withBasicAuth(env('UDEMY_CLIENT_ID'),env('UDEMY_CLIENT_SECRET'));
        $response = $client->get('https://www.udemy.com/api-2.0/courses/', [
            'ratings' => 5,
            'page_size' => 4
        ]);

        return json_decode($response,true);
    }
}