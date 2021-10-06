<?php

namespace App\Repositories;


use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class MarvelRepository
{
    /**
     * Get character list
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(): JsonResponse
    {
        $publicKey = config('app.marvel_public_key');
        $privateKey = config('app.marvel_private_key');
        $url = 'https://gateway.marvel.com:443/v1/public/characters';
        $ts = 1;
        $page = \request('page') ?? 1;
        $length = \request('length') ?? 20;
        $results = (int)$page * (int)$length;
        $offset = (int)$results - (int)$length;
        $response = Http::get($url, [
            'ts' => $ts,
            'apikey' => $publicKey,
            'hash' => md5($ts . $privateKey . $publicKey),
            'orderBy' => \request('orderBy') ?? 'name',
            'limit' => (int)$length,
            'offset' => $offset,
            'nameStartsWith' => \request('query'),
        ]);

        if ($response->failed() || $response->clientError() || $response->serverError()) {
            throw new HttpResponseException(response()->json(
                ['error' => 'An error occurred.']
                , 500)
            );
        }
        return $this->charactersResponse($response->json()['data']);

    }

    /**
     * Character response
     *
     * @param $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function charactersResponse($data): JsonResponse
    {
        $lastPage = $data['total'] / $data['limit'];
        $extra = 0;
        if ($data['total'] % $data['limit']) {
            $extra = 1;
        }
        $lastPage = (int)$lastPage + $extra;
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
