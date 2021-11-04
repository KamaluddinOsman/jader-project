<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(ClientTableSeeder::class);
         $this->call(CategoryTableSeeder::class);
         $this->call(BrandTableSeeder::class);
         $this->call(CarTableSeeder::class);
         $this->call(CityTableSeeder::class);
         $this->call(DistrictTableSeeder::class);
         $this->call(CruiseTableSeeder::class);
         $this->call(StoreTableSeeder::class);
         $this->call(ProductTableSeeder::class);
         $this->call(UnitColorTableSeeder::class);
         $this->call(OfferTableSeeder::class);
         $this->call(SettingTableSeeder::class);
         $this->call(AddresseTableSeeder::class);
         $this->call(RoleTableSeeder::class);
    }
}
