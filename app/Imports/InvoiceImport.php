<?php

namespace App\Imports;

use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class InvoiceImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, ShouldQueue, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd($row);
        return new Invoice([
            'invoice_no' => $row['invoiceno'],
            'stock_code' => $row['stockcode'],
            'description' => $row['description'],
            'quantity' => $row['quantity'],
            'invoice_date' => date('Y-m-d H:i:s', strtotime($row['invoicedate'])),
            'unit_price' => $row['unitprice'],
            'customer_id' => $row['unitprice'],
            'country' => $row['country']
        ]);
    }

    /**
     * Batch size
     *
     *
     * @return int
     * @author Anthony Akro <anthonygakro@gmail.com> [a4anthony]
     */
    public function batchSize(): int
    {
        return 500;
    }

    /**
     * Chunk size
     *
     *
     * @return int
     * @author Anthony Akro <anthonygakro@gmail.com> [a4anthony]
     */
    public function chunkSize(): int
    {
        return 500;
    }

    public function headingRow(): int
    {
        return 1;
    }

}
