<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function index()
    {

        $data = DB::table('task')->orderBy('stock', 'ASC')->get();
        return $data;
//        return view('new.index', compact('data'));

//        return [
//            ['name'=>'somename1','age'=>20],
//            ['name'=>'somename2','age'=>21],
//            ['name'=>'somename3','age'=>22],
//            ['name'=>'somename4','age'=>23],
//            ['name'=>'somename5','age'=>24],
//            ['name'=>'somename6','age'=>25],
//        ];
    }

    public function del($id)
    {
        DB::table('task')->where('variant', '=', $id)->delete();
        return [
            'status' => true,
        ];
    }

    public  function store(Request $request)
    {
        $request->validate([
            'variant'=>'required',
            'stock' =>'required'
        ]);
       // dd($request->all());
        $array1 = [
            'variant'=> $request->get('variant'),
            'stock'=> $request->stock
        ];
       // dd($array1);
        DB::table('task')->insert($array1);
        return(['message'=>'task was successful']);



    }
    public  function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone' =>'required'
        ]);
        DB::create($request->all());



    }
}
