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
                'client_id'=>2 ,
                'email' => 'admin2@here.com', 
                'name' => 'admin',
                'title' => 'Charge Sister', 
                'roles'=>'user', 
                'password' => bcrypt('pass')]);

    }
}
