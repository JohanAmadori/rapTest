<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RappeursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('rappeurs')->insert([
            'nom'  => 'Houdi',
            'note_globale' => 82,
            'vignette'=> 'houdi.jpg',
            'picture'=> 'houdi.png',
            'lien' => 'rappeur/1',
            'musique' => 'houdi.mp3',
            'background'=>"",
            
            'spotify' => 'https://open.spotify.com/intl-fr/artist/0E9vzecg75Thz2ekrGIaF6',
            'insta' => 'https://www.instagram.com/houdihood/',
            'youtube' => 'https://www.youtube.com/@HOUDIHOOD',

        ]);


        DB::table('rappeurs')->insert([
            'nom'  => 'i300',
            'note_globale' => 80,
            'vignette'=> 'i300.jpg',
            'picture'=> 'i300.png',
            'lien' => 'rappeur/2',
            'musique' => 'i300.mp3',
            'spotify' => 'https://open.spotify.com/intl-fr/artist/5crOTgkcDtgMTCoatASEBs',
            'insta' => '',
            'youtube' => 'https://www.youtube.com/@i300_officiel',
        ]);

        DB::table('rappeurs')->insert([
            'nom'  => 'Roro La Meute',
            'note_globale' => 77,
            'vignette'=> 'roro.jpg',
            'picture'=> 'roro.png',
            'lien' => 'rappeur/3',
            'musique' => 'roro.mp3',
            'spotify' => 'https://open.spotify.com/intl-fr/artist/1cmMENrCxOfXMpiM43FRqG',
            'insta' => 'https://www.instagram.com/rorolameute/',
            'youtube' => 'https://www.youtube.com/@rorolameute',
        ]);

        DB::table('rappeurs')->insert([
            'nom'  => 'Lesram',
            'note_globale' => 90,
            'vignette' => 'lesram.jpg',
            'picture'=> 'lesram.png',
            'lien' => 'rappeur/4',
            'musique' => 'lesram.mp3',
            'spotify' => 'https://open.spotify.com/intl-fr/artist/0UeKDbiaApyP7qKfcmGN03?si=afe2ba69aed640be',
            'insta' => 'https://www.instagram.com/lesram310/',
            'youtube' => 'https://www.youtube.com/@lesram3109',
        ]);

        DB::table('rappeurs')->insert([
            'nom'  => 'Zeu',
            'note_globale' => 88,
            'vignette'=> 'zeu.jpg',
            'picture' => 'zeu.png',
            'lien' => 'rappeur/5',
            'musique' => 'zeu.mp3',
            'spotify' => 'https://open.spotify.com/intl-fr/artist/36MWnDH4kn3Sx79LLtLpjF',
            'insta' => 'https://www.instagram.com/zeumystery/',
            'youtube' => 'https://www.youtube.com/@ZEUOFF',
        ]);


        DB::table('rappeurs')->insert([
            'nom'  => 'Laylow',
            'note_globale' => 86,
            'vignette'=> 'laylow.jpg',
            'picture' => 'laylow.png',
            'lien' => 'rappeur/6',
            'musique' => 'laylow.mp3',
            'spotify' => 'https://open.spotify.com/intl-fr/artist/0LnhY2fzptb0QEs5Q5gM7S',
            'insta' => 'https://www.instagram.com/jey.laylow/',
            'youtube' => 'https://www.youtube.com/@laylowxsirkloTV',
        ]);


        DB::table('rappeurs')->insert([
            'nom'  => 'Freeze Corleone',
            'note_globale' => 87,
            'vignette'=> 'freeze.webp',
            'picture'=> 'freeze.png',
            'lien' => 'rappeur/7',
            'musique' => 'freeze.mp3',
            'spotify' => 'https://open.spotify.com/intl-fr/artist/76Pl0epAMXVXJspaSuz8im',
            'insta' => 'https://www.instagram.com/bigfreezecorleone667/',
            'youtube' => 'https://www.youtube.com/channel/UCKU0CiLJ075xJ7Pgq1N5L5g',
        ]);

        DB::table('rappeurs')->insert([
            'nom'  => 'Tif',
            'note_globale' => 83,
            'vignette'=> 'tif.jpg',
            'picture'=> '',
            'lien' => 'rappeur/7',
            'musique' => 'tif.mp3',
            'spotify' => 'https://open.spotify.com/intl-fr/artist/2NgTPluNpfsoYZnoeU2VsH',
            'insta' => 'https://www.instagram.com/the.tif/',
            'youtube' => 'https://www.youtube.com/@The_tif',
        ]);
    }
}
