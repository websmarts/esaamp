<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'client_id'=>1 ,
            'email' => 'admin@here.com', 
            'name' => 'admin',
            'title' => 'Charge Sister', 
            'roles'=>'user', 
            'password' => bcrypt('pass')]);

        User::create([
            'client_id'=>1 ,
            'email' => 'washer@here.com', 
            'name' => 'washer',
            'title' => 'Wash Manager', 
            'roles'=>'washer', 
            'password' => bcrypt('pass')]);

        User::create([
            'client_id'=>1 ,
            'email' => 'caroline@here.com', 
            'name' => 'Caroline Chong',
            'title' => 'Associate Nurse Manager', 
            'roles'=>'manager', 
            'password' => bcrypt('pass')]);
    
        User::create([
            'client_id'=>1 ,
            'email' => 'tarryn@here.com', 
            'name' => 'Tarryn McConnell',
            'title' => 'Manager Inpatient Medical Equipment', 
            'roles'=>'manager', 
            'password' => bcrypt('pass')]); 

        User::create([
            'client_id'=>1 ,
            'email' => 'jamie@here.com', 
            'name' => 'Jamie Ayo',
            'title' => 'Manager Inpatient Medical Equipment', 
            'roles'=>'manager', 
            'password' => bcrypt('pass')]);    

        User::create([
            'client_id'=>2 ,
            'email' => 'admin2@here.com', 
            'name' => 'admin',
            'title' => 'Charge Sister', 
            'roles'=>'manager', 
            'password' => bcrypt('pass')]);

    }
}
