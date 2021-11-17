<?php

use Illuminate\Database\Seeder;
use App\Cruise;

class CruiseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cruise::class, 30)->create();
    }
}
