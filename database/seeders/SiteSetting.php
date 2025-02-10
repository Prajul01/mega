<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting as Setting;

class SiteSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if( Setting::find(1) == null)
        {
            $setting = new Setting;
            $setting->site_title = 'laravel';
            $setting->site_email = 'admin@site.com';
            $setting->logo = 'logo.png';
            $setting->favicon = 'favicon.png';
            $setting->phone = '4400000';
            $setting->mobile = '9800000000';
            $setting->save();
        }else{
            echo "Data Already Exists";
        }
        
    }
}
