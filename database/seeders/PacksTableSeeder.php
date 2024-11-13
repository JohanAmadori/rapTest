<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pack;

class PacksTableSeeder extends Seeder
{
    public function run()
    {
        Pack::create(['name' => 'Pack Simple', 'price' => 100,'prix'=>100]);
        Pack::create(['name' => 'Pack Rare', 'price' => 150,'prix'=>150]);
        Pack::create(['name' => 'Pack Epique', 'price' => 200,'prix'=>200]);
    }
}

