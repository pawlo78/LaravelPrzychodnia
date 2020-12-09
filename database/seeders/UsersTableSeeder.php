<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        DB::table('users')->insert([
            'name' => 'Adam Smith',
            'email' => 'adam@smith.com',
            'password' => bcrypt('password'),
            'phone' => 502487745,
            'address' => 'Łodygowice, Azaliowa 11',
            'status' => 'Active',
            'pesel' => '58457474874',
            'type' => 'admin'
        ]);

        //patient        
        DB::table('users')->insert([
            'name' => 'Tomasz Adamek',
            'email' => 'tomasz@adamek.com',
            'password' => bcrypt('password'),
            'phone' => 546828745,
            'address' => 'Bielsko-Biała, Asnyka 33',
            'status' => 'Active',
            'pesel' => '78037474874',
            'type' => 'patient'
        ]);

        //patient        
        DB::table('users')->insert([
            'name' => 'Mariola Wiśniowska',
            'email' => 'mariola@wisniowska.com',
            'password' => bcrypt('password'),
            'phone' => 669487745,
            'address' => 'Kraków, Domańskiego 33/22',
            'status' => 'Active',
            'pesel' => '88455566777',
            'type' => 'patient'
        ]);

        //doktor        
        DB::table('users')->insert([
            'name' => 'Alan Krysta',
            'email' => 'alan@krysta.com',
            'password' => bcrypt('password'),
            'phone' => 779487745,
            'address' => 'Zabrze, Górnicza 33',
            'status' => 'Active',
            'pesel' => '66090985447',
            'type' => 'doktor'
        ]);

        //doktor        
        DB::table('users')->insert([
            'name' => 'Zuzanna Kubica',
            'email' => 'zuzanna@kubica.com',
            'password' => bcrypt('password'),
            'phone' => 512345285,
            'address' => 'Zamość, Wiejska 44',
            'status' => 'Active',
            'pesel' => '99092374874',
            'type' => 'doktor'
        ]);

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
