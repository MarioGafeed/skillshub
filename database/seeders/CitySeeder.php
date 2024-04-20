<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'القاهرة', 'code' => 'Ca'],
            ['name' => 'الإسكندرية', 'code' => 'Al'],
            ['name' => 'القليوبية', 'code' => 'Qu'],
            ['name' => 'العاشر من رمضان', 'code' => 'Te'],
            ['name' => 'الغربية', 'code' => 'Qa'],
            ['name' => 'البحيرة', 'code' => 'Ba'],
            ['name' => 'مرسى مطروح', 'code' => 'Ma'],
            ['name' => 'كفر الشيخ', 'code' => 'Ka'],
            ['name' => 'المنوفية', 'code' => 'Mo'],
            ['name' => 'الدقهلية', 'code' => 'Da'],
            ['name' => 'الشرقية', 'code' => 'Sh'],
            ['name' => 'دمياط', 'code' => 'Dw'],
            ['name' => 'السويس', 'code' => 'Sa'],
            ['name' => 'الإسماعيلية', 'code' => 'Es'],
            ['name' => 'البحر الأحمر', 'code' => 'Rs'],
            ['name' => 'بورسعيد', 'code' => 'Po'],
            ['name' => 'شمال سيناء', 'code' => 'SN'],
            ['name' => 'جنوب سيناء', 'code' => 'SS'],
            ['name' => 'بنى سويف', 'code' => 'Ba'],
            ['name' => 'الفيوم', 'code' => 'Fa'],
            ['name' => 'المنيا', 'code' => 'Mi'],
            ['name' => 'أسيوط', 'code' => 'As'],
            ['name' => 'الوادى الجديد', 'code' => 'Wa'],
            ['name' => 'سوهاج', 'code' => 'So'],
            ['name' => 'الأقصر', 'code' => 'Au'],
            ['name' => 'قنا', 'code' => 'Qu'],
            ['name' => 'أسوان', 'code' => 'AS'],            
        ];
        foreach ($cities as $key => $value) {
            City::create($value);
        }
    }
}
