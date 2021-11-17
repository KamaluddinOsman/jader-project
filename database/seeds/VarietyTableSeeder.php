<?php

use Illuminate\Database\Seeder;
use App\Variety;

class VarietyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Variety::class, 30)->create();
    }
}
