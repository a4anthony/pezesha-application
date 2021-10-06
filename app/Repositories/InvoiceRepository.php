<?php

namespace App\Repositories;

use App\Jobs\InvoiceImportJob;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class InvoiceRepository
{
    /**
     * Import & upload data
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(): JsonResponse
    {
        $fileName = $this->uploadFile();
        $this->checkProcess();
        if ($fileName) {
            InvoiceImportJob::dispatch(public_path('storage/csv/' . $fileName));
        } else {
            throw new HttpResponseException(response()->json(['error' => 'An error occurred'], 500));
        }
        return response()->json(['message' => 'File uploaded successfully. The import process will begin shortly, please wait a few minutes before trying a new import. '], 200);

    }

    /**
     * Upload file
     *
     *
     * @return string
     */
    public function uploadFile(): string
    {
        $file = request()->file('file');
        $fileName = "";
        if ($file) {
            $ext = strtolower(request()->file('file')->getClientOriginalExtension());
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/csv', $fileName);
            if ($ext !== 'csv') {
                throw new HttpResponseException(response()->json(['error' => 'Invalid file format'], 422));
            }
        }
        return $fileName;
    }

    /**
     * Check process
     *
     *
     * @return void
     */
    public function checkProcess()
    {
        $queue = \DB::table(config('queue.connections.database.table'))->first();
        if ($queue) {
            $payload = json_decode($queue->payload, true);
            if ($payload['displayName'] == 'Maatwebsite\Excel\Jobs\ReadChunk' || $payload['displayName'] == 'App\Jobs\InvoiceImportJob') {
                throw new HttpResponseException(response()->json(
                    ['error' => 'A process is already running. Please wait a few minutes before retrying.']
                    , 409)
                );
            }
        }
    }
}
