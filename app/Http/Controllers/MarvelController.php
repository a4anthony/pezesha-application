<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class MarvelController extends Controller
{
    public function getList()
    {
        $publicKey = config('app.marvel_public_key');
        $privateKey = config('app.marvel_private_key');
        $url = 'https://gateway.marvel.com:443/v1/public/characters';
        $ts = 1;
        $response = Http::get($url, [
            'ts' => $ts,
            'apikey' => $publicKey,
            'hash' => md5($ts . $privateKey . $publicKey),
            //'page'=>3
        ]);
        //$this->makeReturnObject()
        //dd($response->json());
        return $this->charactersResponse($response->json()['data']);
    }

    public function charactersResponse($data)
    {
        return response()->json([
            'from' => $data['offset'],
            'to' => $data['count'],
            'length' => $data['limit'],
            'total' => $data['total'],
            'count' => $data['count'],
            'data' => $data['results'],
        ]);
    }
}
