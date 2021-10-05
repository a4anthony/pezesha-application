<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class MarvelController extends Controller
{
    public function getList()
    {
        //dd(\request()->all());
        $publicKey = config('app.marvel_public_key');
        $privateKey = config('app.marvel_private_key');
        $url = 'https://gateway.marvel.com:443/v1/public/characters';
        $ts = 1;


        $page = \request('page') ?? 1;
        $length = \request('length') ?? 20;

        $results = (int)$page * (int)$length;
        $offset = (int)$results - (int)$length;
        //$total = 1559;
        //$lastPage =
        //    dump('page ' . $page);
        //dump('length ' . $length);
        //dump('results ' . $results);
        //dd($offset);
        $response = Http::get($url, [
            'ts' => $ts,
            'apikey' => $publicKey,
            'hash' => md5($ts . $privateKey . $publicKey),
            'orderBy' => \request('orderBy') ?? 'name',
            'limit' => (int)$length,
            'offset' => $offset,
            'nameStartsWith' => \request('query'),
            //'page'=>3
        ]);
        //$this->makeReturnObject()
        //dd($response->body());
        //dump($response->json()['data']);
        return $this->charactersResponse($response->json()['data']);
    }

    public function charactersResponse($data)
    {
        $lastPage = $data['total'] / $data['limit'];
        $extra = 0;
        if ($data['total'] % $data['limit']) {
            $extra = 1;
        }
        $lastPage = (int)$lastPage + $extra;
        //dump($data['total'] % $data['limit']);
        //dump($lastPage);
        //dd([
        //    'from' => $data['offset'] + 1,
        //    'to' => $data['offset'] + $data['count'],
        //    'length' => $data['limit'],
        //    'total' => $data['total'],
        //    'count' => $data['count'],
        //    'data' => $data['results'],
        //    'last_page' => $lastPage,
        //    'current_page' => (int)\request('page') ?? 1,
        //
        //]);
        return response()->json([
            'from' => $data['offset'] + 1,
            'to' => $data['offset'] + $data['count'],
            'length' => $data['limit'],
            'total' => $data['total'],
            'count' => $data['count'],
            'data' => $data['results'],
            'last_page' => $lastPage,
            'current_page' => \request('page') ? (int)\request('page') : 1,
        ]);
    }
}
