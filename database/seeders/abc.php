<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class abc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //specialization 1        
        DB::table('specializations')->insert([
            'name' => 'oncology'
        ]);

        //specialization 1        
        DB::table('specializations')->insert([
            'name' => 'surgeon'
        ]);

        //specialization 1        
        DB::table('specializations')->insert([
            'name' => 'internist'
        ]);
    }
}
