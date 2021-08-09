<?php

namespace App\Jobs;

use App\Http\Controllers\ExportExcelController;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NewUserFileExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = DB::table('task')->selectRaw("variant as SKU, GROUP_CONCAT(stock SEPARATOR '|') as stock_id")->groupBy(['SKU'])->get();
        $export_array = [];
        foreach ($data as $key => $item) {
            $export_array[] = ['variant' => $item->SKU, 'stock' => $item->stock_id];
        }
        $newFile = 'excel_' . rand(1, 12000);
        Excel::create($newFile, function ($excel) use ($export_array) {
            $excel->setTitle('Export Data');
            $excel->sheet('Export Data', function ($sheet) use ($export_array) {
                $sheet->fromArray($export_array, null, 'A1', false, false);
            });
        })->store('xlsx',storage_path('app/public/exports'));
        $path = '/storage/exports/' . $newFile . '.xlsx';
        $toInsert = [
            'filepath' => $path  // 'column_name'=>'value to be inserted or updated'
        ];
        DB::table('filepath')->insert($toInsert);
    }
}
