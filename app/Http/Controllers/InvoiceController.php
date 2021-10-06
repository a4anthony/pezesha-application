<?php

namespace App\Http\Controllers;

use App\Imports\InvoiceImport;
use App\Jobs\InvoiceImportJob;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * @var \App\Services\InvoiceService
     */
    private $invoiceService;

    /**
     * @param \App\Services\InvoiceService $invoiceService
     */
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Import & upload data
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(): JsonResponse
    {
        return $this->invoiceService->import();
    }
}
