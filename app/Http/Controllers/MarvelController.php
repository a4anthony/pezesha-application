<?php

namespace App\Http\Controllers;

use App\Services\MarvelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class MarvelController extends Controller
{
    /**
     * @var \App\Services\MarvelService
     */
    private $marvelService;

    /**
     * @param \App\Services\MarvelService $marvelService
     */
    public function __construct(MarvelService $marvelService)
    {
        $this->marvelService = $marvelService;
    }

    /**
     * Get character list
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(): JsonResponse
    {
        return $this->marvelService->getList();
    }
}
