<?php

namespace App\Services;

use App\Repositories\MarvelRepository;
use Illuminate\Http\JsonResponse;

class MarvelService
{
    /**
     * @var \App\Repositories\MarvelRepository
     */
    private $marvelRepository;

    public function __construct(MarvelRepository $marvelRepository)
    {
        $this->marvelRepository = $marvelRepository;
    }

    /**
     * Get character list
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList(): JsonResponse
    {
        return $this->marvelRepository->getList();
    }
}
