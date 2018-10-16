<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(SitesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(AssetTypesTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
    }
}
