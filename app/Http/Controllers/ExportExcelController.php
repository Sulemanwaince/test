<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserFileExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    /**
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */

    function excel(Request $request)
    {
        $data = DB::table('task')->selectRaw("variant as SKU, GROUP_CONCAT(stock SEPARATOR '|') as stock_id")->groupBy(['SKU'])->get();

        $export_array = [];
        foreach ($data as $item) {

            $export_array[] = ['variant' => $item->SKU, 'stock' => $item->stock_id];
        }
        //dd($data);


        if (Storage::disk('local')->exists("app//")) {
            dd("dsfsd");

            $path = Storage::disk('local')->path("app//");
            $content = file_get_contents($path);
//            return  response($content)->withHeaders([
//                'Content-Type'=> mime_content_type($path)
//
//            ]);

            if ($request->hasFile($path)) {
                $filename = $request->file('file')->getClientOriginalName();
                $filename = url("app\\") .
                    "/" . uniqid() .
                    $request->file('file')
                        ->getClientOriginalName();
                $destinationPath = "app\\";
                $request->file('file')->move($destinationPath, $filename);

            }
            NewUserFileExport::dispatch($path)->delay(now()->addMinute(1));

        }

//        $sales->csv_file = $destinationPath.'/'.$name;
//        $sales>save();


//     return redirect(('/404'));

        //  dd("dfssssdfsdff");
        // return DB::select("select * from filepath");
//
//        if ($request->hasFile('file')) {
//            $filename = $request->file('file')->getClientOriginalName();
//            $filename = url("app\\") .
//                "/" . uniqid() .
//                $request->file('file')
//                    ->getClientOriginalName();
//            $destinationPath = "file";
//            $request->file('file')->move($destinationPath, $filename);
//            $post->image = $filename;
//        }


//
//        $file = $request->file('export');
//        if ($file->isValid()) {
//            $hashedName = hash_file('md5', $file->path());

//            Storage::disk('local')->put($newFile, file_get_contents($file));
//        }
//
//        $path = storage_path('app\\'.$newFile);
//        NewUserFileExport::dispatch($path)->delay(now()->addMinute(1));
        $timestamp = rand(1, 12000);
        $newFile = $timestamp;
        Excel::create($timestamp, function ($excel) use ($export_array) {
            $excel->setTitle('Export Data');
            $excel->sheet('Export Data', function ($sheet) use ($export_array) {
                $sheet->fromArray($export_array, null, 'A1', false, false);
            });
        })->store('xlsx');

        $path = 'exports\\' . $newFile . '.xlsx';
        $array2 = [
            'filepath' => $path  // 'column_name'=>'value to be inserted or updated'

        ];

        DB::table('filepath')->insert($array2);

        // $data1 = DB::table('filepath')->get();

//        $data = DB::select('select * from filepath');
        NewUserFileExport::dispatch($path)->delay(now()->addMinute(1));
        dd($path);

        return Storage::download($path);


//        $data1 = DB::select('select * from filepath');
//        return view('welcome',['filepath'=>$data1]);


//        return view("export_file_download");
//        dd($path);


        // $path = $request->$path->store('');
//
//        return $path;


        //  DB::table('filepath')->store($);


//        $path = $request->file('')->store(
//            '', 'public'
//        );


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
