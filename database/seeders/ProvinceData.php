<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'name'=>'Koshi Pradesh',
            'slug'=>'koshi-pradesh',
            'status'=>'active',
            'country_id'=>1,
            'order_no'=>'1',
           ]);
           Province::create([
            'name'=>'Madhesh Pradesh',
            'slug'=>'madhesh-pradesh',
            'status'=>'active',
            'country_id'=>1,
            'order_no'=>'2',
           ]);
           Province::create([
            'name'=>'Bagmati Pradesh',
            'slug'=>'bagmati-pradesh',
            'status'=>'active',
            'country_id'=>1,
            'order_no'=>'3',
           ]);
           Province::create([
            'name'=>'Gandaki Pradesh',
            'slug'=>'gandaki-pradesh',
            'status'=>'active',
            'country_id'=>1,
            'order_no'=>'4',
           ]);   
            Province::create([
            'name'=>'Lumbini Pradesh',
            'slug'=>'lumbini-pradesh',
            'status'=>'active',
            'country_id'=>1,
            'order_no'=>'5',
           ]);
           Province::create([
            'name'=>'Karnali Pradesh',
            'slug'=>'karnali-pradesh',
            'status'=>'active',
            'country_id'=>1,
            'order_no'=>'6',
           ]);
           Province::create([
            'name'=>'Sudurpashchim Pradesh',
            'slug'=>'sudurpashchim-pradesh',
            'status'=>'active',
            'country_id'=>1,
            'order_no'=>'7',
           ]);
    }
}
