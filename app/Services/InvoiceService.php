<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;

class InvoiceService
{
    /**
     * @var \App\Repositories\InvoiceRepository
     */
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Import & upload data
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(): \Illuminate\Http\JsonResponse
    {
        return $this->invoiceRepository->import();
    }
}
