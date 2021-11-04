<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [

            array('name' => 'jadeeer' , 'About' => 'تطبيك كل شئ هو فعلا تطبيق يحتوى على كل ما تريد لراحتك ولتوفير المال', 'commission' => '10' , 'phone' => '01012315376' , 'site' => 'www.everything.com' ,'facebook' => 'https://www.facebook.com/ahmedFayed2018/' ,'logo' => 'https://is4-ssl.mzstatic.com/image/thumb/Purple113/v4/ee/91/eb/ee91ebc6-f7e6-2fa2-356e-d5930900691b/AppIcon-0-0-1x_U007emarketing-0-0-0-7-0-0-sRGB-0-0-0-GLES2_U002c0-512MB-85-220-0-0.png/246x0w.png'),
        ];

        foreach ($list as $setting) {
            Setting::insert([
                'name'       => $setting['name'],
                'About'      => $setting['About'],
                'commission' => $setting['commission'],
                'phone'      => $setting['phone'],
                'site'       => $setting['site'],
                'facebook'   => $setting['facebook'],
                'logo'       => $setting['logo'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
