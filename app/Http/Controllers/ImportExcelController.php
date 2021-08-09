<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserFileUpload;
use App\Jobs\NewUserRegisterEmail;
use Illuminate\Http\Request;
use DB;
use Excel;
use Illuminate\Support\Facades\Storage;

class ImportExcelController extends Controller
{
    function index()
    {
        //  dd('sdas');
        $data = DB::table('task')->orderBy('stock', 'ASC')->get();
        return view('import_excel', compact('data'));
    }

    /**
     * @param Request $request
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    function import(Request $request)
    {
        //dd("sfsd");


        $this->validate($request, [
            'select_file' => 'required|mimes:csv,txt'
        ]);
        if ($request->hasFile('select_file')) {
            $file = $request->file('select_file');
            if ($file->isValid()) {
                $hashedName = hash_file('md5', $file->path());
                $timestamp = rand(1,12000);
                $newFilename = $hashedName . $timestamp . '.' . $file->getClientOriginalExtension();
                Storage::disk('local')->put($newFilename, file_get_contents($file));
            }
        }
        $path = storage_path('app\\'.$newFilename);

       // $path = $request->file('select_file')->getRealPath();

        NewUserFileUpload::dispatch($path)->delay(now()->addMinute(1));

        return back()->with('success', 'CSV Data Imported successfully.');
    }

    function importBackground($path)
    {
        //dd("sfsd")

        //  $path = $request->file('select_file')->getRealPath();

        // loading the data

        $data = Excel::load($path)->get();

        foreach ($data as $item) {

            $insert_data[] = array(
                'variant' => $item->variant,
                'stock' => $item->stock,

            );
        }

        if (!empty($insert_data)) {
            DB::table('task')->insert($insert_data);
        }
        //return back()->with('success', 'CSV Data Imported successfully.');
    }

    public function exportBackground($path)
    {
    }

}
