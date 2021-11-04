<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use App\Client;
use App\User;
use App\Brand;
use App\Category;
use App\Car;
use App\Cruise;
use App\City;
use App\District;
use App\Store;
use App\Offer;
use App\Product;
use App\Variety;
use App\UnitColor;
use App\ProductItem;
use Illuminate\Support\Str;


//User
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['Ahmed Fayed']),
        'email' => 'ahmedfayed1000@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$ZKwOkxy.maiwv6/Wpl10/OlfVPbY5ddo9HsNsVZYlCHY6fkanbT5a', // password
        'remember_token' => Str::random(10),
    ];
});


// Client Factory
$factory->define(Client::class, function (Faker\Generator $faker) {

    return [
        'first_name'             => $faker->randomElement(['هادي', 'هارون', 'هاشم', 'هانى','مازن', 'مالك', 'مامون', 'ماهر', 'هاني','عبد الله', 'عبد المجيد', 'حسن', 'حسني', 'حسين','سعد', 'حسن', 'حسني', 'حسين', 'جمال', 'جمزه','خالد','فادي', 'فارس', 'فاروق', 'فاضل','يوسف', 'يونس']),
        'last_name'              => $faker->randomElement([ 'هشام', 'هلال','عزالدين', 'عزام', 'عزت', 'عزمي','عبدالعزيز', 'عبدالفتاح', 'عبدالقادر', 'عبدالكريم', 'عبداللطيف', 'عبدالله','عبدالجليل', 'عبدالجواد', 'عبدالحليم', 'عبدالحميد', 'عبدالرؤوف', 'عبدالرحمن', 'عبدالرحيم', 'عبدالرزاق']),
        'full_name'              => $faker->randomElement(['خالد احمد ابراهيم','محمد ابراهيم مصطفى','حسن اسماعيل يونس','عمار احمد الشريعى','صفى مهاب حسن','غادة عادل ابراهيم','نفين نظمى حسن','مى عادل احمد','انس السعيد سامح','يوسف منصور مؤنس','حامد صلاح ابو الفتوح','مريم عادل مصطفى','حسنى ابراهيم عبد الودود','بيومى فؤاد عبد الصمد','محمد عادل المنصورى']),
        'gender'                 => 'male',
        'activated'              => $faker->randomElement(['0' ,'1']),
        'phone'                  => $faker->phoneNumber,
        'image'                  => $faker->imageUrl(400, 300),
        'email'                  => $faker->unique()->email,
        'password'               => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
//        'api_token'              => Str::random(60),
        'verification_code'      => $faker->numberBetween($min = 1000, $max = 90000),
        'district_id'            => $faker->numberBetween($min = 1, $max = 30),
    ];
});


// Category Factory
$factory->define(Category::class,function (Faker\Generator $faker){
    return [
        'name'             => $faker->randomElement(['السيارات', 'الاثاث','المطاعم', 'ادوات سباكة','مقاولات', 'الكترونيات','مناسبات', 'ادوات كهربائية', 'ادوات تجميل', 'مواد بناء' ,'ادوات كهرباء' ,'رياضة' ,'ادوات زراعية' ,'ادوات منزلية' ,'المونيوم', 'سياحه وسفر' ]),
        'image'            => $faker->imageUrl(400, 300),
    ];
});

// Brand Factory
$factory->define(Brand::class,function (Faker\Generator $faker){
    return [
        'category_id'      => Category::all()->random()->id,
        'name'             => $faker->randomElement(['Apple', 'Samsung','Disney', 'Toyota','McDonalds', 'AT&T','Louis Vuitton', 'Intel', 'NIKE', 'Cisco' ,'	GE' ,'Mercedes-Benz' ,'IBM' ,'BMW' ,'SAP', 'Marlboro' ,'Honda' ,'Starbucks', '	IKEA' , 'Audi' ,'Zara' ,'Ford' ,'HP' ,'Sony', '	Chevrolet']),


    ];
});

// Car Factory
$factory->define(Car::class,function (Faker\Generator $faker){
    return [
        'Client_id'             => Client::all()->random()->id,
        'Type_car'              => $faker->randomElement(['1', '2', '3', '4']),
        'number'                => $faker->numberBetween($min = 1000, $max = 7885),
        'driver_license'        => $faker->imageUrl(400, 300),
        'car_license'           => $faker->imageUrl(400, 300),
        'personal_id'           => $faker->imageUrl(400, 300),
        'car_model'             => $faker->randomElement(['1994','1950','1999','2013','2015','2005','2001','2011','1830']),
        'image_car_front'       => $faker->imageUrl(400, 300),
        'image_car_back'        => $faker->imageUrl(400, 300),
        'brand_id'             => $faker->randomElement(['1', '2', '3', '4','5', '6','7', '8', '9', '10']),
        'activated'             => $faker->randomElement(['0' ,'1'])
    ];
});


// Cruise Factory
$factory->define(Cruise::class,function (Faker\Generator $faker){
    return [
        'car_id'          => Car::all()->random()->id,
        'client_id'       => Client::all()->random()->id,
        'duration'        => $faker->numberBetween($min = 15, $max = 70),
        'starting_point'  => $faker->randomElement(['9.102097','35.421585','57.326521','288.788602','82.285331','-10.841728','82.130427','44.214540','43.950692']),
        'end_point'       => $faker->randomElement(['9.102097','35.421585','57.326521','288.788602','82.285331','-10.841728','82.130427','44.214540','43.950692']),
        'price'           => $faker->numberBetween($min = 10, $max = 110),
        'code'            => $faker->numberBetween($min = 2222, $max = 8888),
        'status'          => $faker->randomElement(['pending', 'accepted', 'canceled',]),
    ];
});

// Store Factory
$factory->define(Store::class,function (Faker\Generator $faker){
    return [
        'category_id'        => Category::all()->random()->id,
        'client_id'          => Client::all()->random()->id,
        'city_id'        => City::all()->random()->id,
        'logo'               => $faker->imageUrl(400, 300),
        'name'               => $faker->randomElement(['Start Smart' ,'Passion Education','Little Feats','Green Sprout','A Step Ahead','Kinderhaus','Amazing Alaska','Baby Stars']),
        'phone1'             => $faker->phoneNumber,
        'phone2'             => $faker->phoneNumber,
        'company_register'   => $faker->numberBetween($min = 1111111, $max = 9999999),
        'num_tax'   => $faker->numberBetween($min = 1111111, $max = 9999999),
        'address'            => $faker->randomElement(['نجير' ,'دكرنس','شربين','المنصورة','القاهرة','العاشر']),
        'lang'               => $faker->randomElement(['9.102097','35.421585','57.326521','288.788602','82.285331','-10.841728','82.130427','44.214540','43.950692']),
        'late'               => $faker->randomElement(['9.102097','35.421585','57.326521','288.788602','82.285331','-10.841728','82.130427','44.214540','43.950692']),
        'about'              =>'مرحبا بك نحن مؤسسة من اكبر واعرق المؤسسات فى العالم فى التجارة والصناعة والتوزيع',
        'minimum_order'      => $faker->numberBetween($min = 60, $max = 100),
        'delivery_price'     => $faker->numberBetween($min = 55, $max = 90),
        'whatsapp'           => $faker->randomElement(['0201012315376','0201018437320']),
        'facebook'           => $faker->randomElement(['https://www.facebook.com/ahmedFayed2018','https://www.facebook.com/SMSAF77']),
        'active'             => $faker->randomElement(['0', '1']),
    ];
});

// Product Factory
$factory->define(Product::class,function (Faker\Generator $faker){
    return [
        'store_id'  => Store::all()->random()->id,
//        'category_id'  => Category::all()->random()->id,
        'brands_id'     => Brand::all()->random()->id,
        'name'          => $faker->randomElement(['تيشيرت' ,'ايفون','خلاط 6 سرعات','غسالة اوتماتيك','تلاجه 18 قدم','شانيور خرسانة','لاب توب','بوكسرات']),
        'rate'          => $faker->randomElement(['2', '5']),
        'price'         => $faker->randomElement(['30', '200']),
        'code'          => $faker->randomElement(['1111', '9999']),
        'quantity'      => $faker->randomElement(['1', '50']),
        'image1'        => $faker->imageUrl(400, 300),
        'image2'        => $faker->imageUrl(400, 300),
        'image3'        => $faker->imageUrl(400, 300),
        'image4'        => $faker->imageUrl(400, 300),
        'notes'         => $faker->text,
        'type'          => $faker->randomElement(['0', '1']), //'service', 'product'

    ];
});

// UnitColor Factory
$factory->define(UnitColor::class,function (Faker\Generator $faker){
    return [
        'category_id' => Category::all()->random()->id,
        'name'        => $faker->randomElement(['احمر' ,'اصفر','اخضر','اسود','ابيض','x','xl','xxl']),
        'code'        => $faker->randomElement(['#0fbed8' ,'#0fbed8','#eae6e3','#588585','#6495ed','#fb4d4f','#efa79b','#edbc6d']),
        'type'        => $faker->randomElement(['unit' ,'color']),
    ];
});

// ProductItem Factory
$factory->define(ProductItem::class,function (Faker\Generator $faker){
    return [
        'product_id'  => Product::all()->random()->id,
        'unit_id'     => UnitColor::all()->random()->id,
        'color_id'    => UnitColor::all()->random()->id,
        'name'        => $faker->randomElement(['تيشيرت' ,'ايفون','خلاط 6 سرعات','غسالة اوتماتيك','تلاجه 18 قدم','شانيور خرسانة','لاب توب','بوكسرات']),
        'code'        => $faker->numberBetween($min = 2222, $max = 8888),
        'price'       => $faker->numberBetween($min = 10, $max = 700),
        'quantity'    => $faker->randomElement(['5', '15']),

    ];
});

// Offer Factory
$factory->define(Offer::class,function (Faker\Generator $faker){
    return [
        'product_id'      => Product::all()->random()->id,
        'name'            => $faker->randomElement(['خصم الصيف' ,'خصم الشتاء','خخصم 50%','خصم عيد الام','خصم العيد','خصم الفرحة']),
        'desc'            => $faker->randomElement(['خصم الصيف' ,'خصم الشتاء','خخصم 50%','خصم عيد الام','خصم العيد','خصم الفرحة']),
//        'image'           => $faker->imageUrl(400, 300),
        'discount'        => $faker->numberBetween($min = 15, $max = 30),
        'price'           => $faker->numberBetween($min = 2, $max = 20),
        'start'           => $faker->dateTimeBetween($startDate = '- 10 days',$endDate = 'now', $timezone = null),
        'end'             => $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 10 days', $timezone = null),
        'discount_value'  => $faker->numberBetween($min = 10, $max = 700),

    ];
});

// Offer Factory
$factory->define(Address::class,function (Faker\Generator $faker){
    return [
        'client_id'      => Client::all()->random()->id,
        'lang'           => $faker->numberBetween($min = -90, $max = 90),
        'late'           => $faker->numberBetween($min = -180, $max = 180),
    ];
});








