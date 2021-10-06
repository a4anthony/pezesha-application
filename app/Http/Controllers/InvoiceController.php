<?php

namespace App\Http\Controllers;

use App\Imports\InvoiceImport;
use App\Jobs\InvoiceImportJob;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function import()
    {


        if (\request()->wantsJson()) {
            $file = request()->file('file');
            $ext = strtolower(request()->file('file')->getClientOriginalExtension());
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/csv', $fileName);
            if ($ext !== 'csv') {
                throw new HttpResponseException(response()->json(['error' => 'Invalid file format'], 422));
            }

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
            InvoiceImportJob::dispatch(public_path('storage/csv/' . $fileName));
            return response()->json(['message' => 'File uploaded successfully. The import process will begin shortly, please wait a few minutes before trying a new import. '], 200);
        } else {
            dd('here');
        }
    }
}
