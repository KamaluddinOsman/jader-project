<?php

use Illuminate\Database\Seeder;
use App\District;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [

            array('name' => 'Al Safa', 'city_id' => 1),
            array('name' => 'Al Faisaliyah', 'city_id' => 6),
            array('name' => 'North Ghurāb Lighthouse', 'city_id' => 2),
            array('name' => 'Awwad', 'city_id' => 3),
            array('name' => 'Anak', 'city_id' => 4),
            array('name' => 'Bisha', 'city_id' => 5),
            array('name' => 'Bareg', 'city_id' => 7),
            array('name' => 'Dhurma', 'city_id' => 9),
            array('name' => 'Duba', 'city_id' => 8),
            array('name' => 'Dawadmi', 'city_id' => 10),
            array('name' => 'Gerrha', 'city_id' => 11),
            array('name' => 'Hajrah', 'city_id' => 12),
            array('name' => 'Hofuf', 'city_id' => 13),
            array('name' => 'Jizan', 'city_id' => 14),
            array('name' => 'Khobar', 'city_id' => 15),
        ];

        foreach ($list as $city) {
            District::insert([
                'name' => $city['name'],
                'city_id' => $city['city_id'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
