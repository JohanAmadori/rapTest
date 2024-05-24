<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('articles')->insert([
            'nom'  => 'Booba',
            'note' => 95,
            'prix_public' => 100,
            'img'=> 'pictures/' . 'booba.png',

        ]);


        DB::table('articles')->insert([
            'nom'  => 'Alpha Wann',
            'note' => 92,
            'prix_public' => 95,
            'img'=> 'pictures/' . 'alpha.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Alkpote',
            'note' => 90,
            'prix_public' => 90,
            'img'=> 'pictures/' . 'alkpote.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Lesram',
            'note' => 90,
            'prix_public' => 80,
            'img'=> 'pictures/' . 'lesram.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Freeze Corleone ',
            'note' => 88,
            'prix_public' => 75,
            'img'=> 'pictures/' . 'freeze.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Zeu',
            'note' => 88,
            'prix_public' => 75,
            'img'=> 'pictures/' . 'zeu.png',           

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Josman',
            'note' => 87,
            'prix_public' => 70,
            'img'=> 'pictures/' . 'josman.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Vald',
            'note' => 87,
            'prix_public' => 70,
            'img'=> 'pictures/' . '',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Laylow',
            'note' => 86,
            'prix_public' => 65,
            'img'=> 'pictures/' . 'laylow.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Luv Resval',
            'note' => 86,
            'prix_public' => 65,
            'img'=> 'pictures/' . 'luv_resval.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Tif',
            'note' => 83,
            'prix_public' => 55,
            'img'=> 'pictures/' . '',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Zamdane',
            'note' => 82,
            'prix_public' => 50,
            'img'=> 'pictures/' . 'zamdane.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Houdi ',
            'note' => 82,
            'prix_public' => 50,
            'img'=> 'pictures/' . 'houdi.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'i300 ',
            'note' => 80,
            'prix_public' => 50,
            'img'=> 'pictures/' . 'i300.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Roro La Meute ',
            'note' => 77,
            'prix_public' => 40,
            'img'=> 'pictures/' . 'roro.png',

        ]);

    }    
}
