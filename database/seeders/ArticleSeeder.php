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
            'prix_public' => 200,
            'img'=> 'pictures/' . 'booba.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Kaaris',
            'note' => 92,
            'prix_public' => 160,
            'img'=> 'pictures/' . 'kaaris.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Alpha Wann',
            'note' => 92,
            'prix_public' => 160,
            'img'=> 'pictures/' . 'alpha.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Niro',
            'note' => 91,
            'prix_public' => 150,
            'img'=> 'pictures/' . 'niro.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Alkpote',
            'note' => 90,
            'prix_public' => 140,
            'img'=> 'pictures/' . 'alkpote.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Lesram',
            'note' => 90,
            'prix_public' => 120,
            'img'=> 'pictures/' . 'lesram.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Vald',
            'note' => 89,
            'prix_public' => 110,
            'img'=> 'pictures/' . 'vald.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Freeze Corleone ',
            'note' => 88,
            'prix_public' => 100,
            'img'=> 'pictures/' . 'freeze.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Zeu',
            'note' => 88,
            'prix_public' => 100,
            'img'=> 'pictures/' . 'zeu.png',           

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Josman',
            'note' => 87,
            'prix_public' => 95,
            'img'=> 'pictures/' . 'josman.png',

        ]);


        DB::table('articles')->insert([
            'nom'  => 'Laylow',
            'note' => 86,
            'prix_public' => 90,
            'img'=> 'pictures/' . 'laylow.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Luv Resval',
            'note' => 86,
            'prix_public' => 90,
            'img'=> 'pictures/' . 'luv_resval.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'PLK',
            'note' => 85,
            'prix_public' => 85,
            'img'=> 'pictures/' . 'plk.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Ziak',
            'note' => 84,
            'prix_public' => 80,
            'img'=> 'pictures/' . 'ziak.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'ZKR',
            'note' => 83,
            'prix_public' => 75,
            'img'=> 'pictures/' . 'zkr.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Green Montana',
            'note' => 83,
            'prix_public' => 75,
            'img'=> 'pictures/' . 'green.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Malty2bz',
            'note' => 82,
            'prix_public' => 70,
            'img'=> 'pictures/' . 'malty2bz.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'So la lune',
            'note' => 82,
            'prix_public' => 70,
            'img'=> 'pictures/' . 'solalune.png',

        ]);


        DB::table('articles')->insert([
            'nom'  => 'Zamdane',
            'note' => 82,
            'prix_public' => 70,
            'img'=> 'pictures/' . 'zamdane.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Houdi ',
            'note' => 82,
            'prix_public' => 70,
            'img'=> 'pictures/' . 'houdi.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Fresh',
            'note' => 80,
            'prix_public' => 60,
            'img'=> 'pictures/' . 'fresh.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'i300 ',
            'note' => 80,
            'prix_public' => 60,
            'img'=> 'pictures/' . 'i300.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Saif ',
            'note' => 79,
            'prix_public' => 50,
            'img'=> 'pictures/' . 'saif.png',

        ]);

        DB::table('articles')->insert([
            'nom'  => 'Roro La Meute ',
            'note' => 76,
            'prix_public' => 40,
            'img'=> 'pictures/' . 'roro.png',

        ]);

    }    
}
