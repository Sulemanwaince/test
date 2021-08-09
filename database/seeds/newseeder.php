<?php

use Illuminate\Database\Seeder;

class newseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    DB::table('new')->insert([
        'variant'=>'2244-BLSM-L',
        'stock'=>'100'

    ]);
        //
    }
}
