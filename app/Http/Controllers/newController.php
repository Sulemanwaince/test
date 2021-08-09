<?php

namespace App\Http\Controllers;

use App\Jobs\NewUserFileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Excel;

class newController extends Controller
{
   public function index()
    {
//        $data = DB::table('task')->orderBy('stock', 'ASC')->get();
//        return view('new.index', compact('data'));
        return view('new.index');
    }

    public  function create()
    {

    }







}
