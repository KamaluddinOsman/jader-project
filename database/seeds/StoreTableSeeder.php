<?php

use Illuminate\Database\Seeder;
use App\Store;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Store::class, 30)->create();
    }
}
