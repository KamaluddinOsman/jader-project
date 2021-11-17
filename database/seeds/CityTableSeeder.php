<?php

use Illuminate\Database\Seeder;
use App\City;


class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [

            array('name' => 'Abhā'),
            array('name' => 'Abqaiq'),
            array('name' => 'Al-Dammām'),
            array('name' => 'Al-Jawf'),
            array('name' => 'Al-Khubar'),
            array('name' => 'Al-Qaṭīf'),
            array('name' => 'Al-Ṭaʾif'),
            array('name' => 'Buraydah'),
            array('name' => 'Dhahran'),
            array('name' => 'Jiddah'),
            array('name' => 'Khamīs Mushayt'),
            array('name' => 'Medina'),
            array('name' => 'Najrān'),
            array('name' => 'Riyadh'),
            array('name' => 'Tabūk'),
            ];

        foreach ($list as $city) {
            City::insert([
                'name' => $city['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
