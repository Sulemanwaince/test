<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserFileExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ExportExcelController extends Controller
{
    function index()
    {

//        SELECT  variant as SKU,
//GROUP_CONCAT(stock SEPARATOR '|') as stock_id
//FROM task GROUP BY variant;

        $data = DB::table('task')->get()->toArray();

        return view('export_excel')->with('data', $data);
    }


    function excel()
    {
        NewUserFileExport::dispatch()->delay(now()->addMinutes(1));
        return ['response'=>'status'];
    }

    public function download()
    {
        $data = DB::select('select * from filepath');
        return view('welcome', ['filepath' => $data]);
    }

    function exportBackground($path)
    {
        //dd("sfsd");


        $data = Excel::all();

        NewUserFileExport::dispatch($path)->delay(now()->addMinute(1));

        foreach ($data as $item) {

            $insert_data[] = array(
                'variant' => $item->variant,
                'stock' => $item->stock,

            );
        }


        return back()->with('success', 'xlsx Data Exported successfully.');
    }


}
