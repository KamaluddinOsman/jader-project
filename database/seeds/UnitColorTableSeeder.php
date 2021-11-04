<?php

use Illuminate\Database\Seeder;
use App\UnitColor;

class UnitColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UnitColor::class, 30)->create();
    }
}
