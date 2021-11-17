<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddresseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Address::class, 20)->create();
    }
}
