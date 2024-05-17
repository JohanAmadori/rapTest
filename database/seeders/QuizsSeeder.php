<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     /*ZEU*/
    public function run(): void
    {
        DB::table('quizs')->insert([
            'rappeur_id'  => 5,
            'question' => "De quel groupe faisait-il partie ?",
            'reponse1' => "1995",
            'reponse2' => "Panama Bende",
            'reponse3' => "Scred Connexion",
            'reponse4' => "Collectif Metissé",
            'reponse' => 2,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 5,
            'question' => "Avec qui il n'a jamais collaboré ?",
            'reponse1' => "34 Murphy",
            'reponse2' => "Samou Skuu",
            'reponse3' => "Venom",
            'reponse4' => "PLK",
            'reponse' => 1,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 5,
            'question' => "A quel politicien fait-il référence dans un de ces sons ?",
            'reponse1' => "Gerald Darmanin",
            'reponse2' => "Eric Zemmour",
            'reponse3' => "Christophe Castaner",
            'reponse4' => "Nicolas Sarkozy",
            'reponse' => 3,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 5,
            'question' => "Quel est son Top Titre le plus ecouté sur Deezer ?",
            'reponse1' => "BVB",
            'reponse2' => "Decepticons",
            'reponse3' => "Haaland",
            'reponse4' => "Opp Block",
            'reponse' => 1,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 5,
            'question' => "Quel est le nom de son premier album/EP ?",
            'reponse1' => "Watergate",
            'reponse2' => "Butterfly Doors",
            'reponse3' => "Trashtalking",
            'reponse4' => "Boss Orders",
            'reponse' => 3,
            'difficulte' => ""

        ]);

        /*LESRAM*/
        DB::table('quizs')->insert([
            'rappeur_id'  => 4,
            'question' => "De quel département est-il originaire ?",
            'reponse1' => "92",
            'reponse2' => "93",
            'reponse3' => "94",
            'reponse4' => "75",
            'reponse' => 2,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 4,
            'question' => "Avec qui il n'a jamais collaboré ?",
            'reponse1' => "Alpha Wann",
            'reponse2' => "Aladin 135",
            'reponse3' => "Zeu",
            'reponse4' => "Osirus Jack",
            'reponse' => 3,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 4,
            'question' => "Dans quel son dit-il :'Un mensonge, c'est une plume, face au poids d'la vérité' ?",
            'reponse1' => "CNN",
            'reponse2' => "Wesh Enfoiré #5",
            'reponse3' => "Intro",
            'reponse4' => "Seum",
            'reponse' => 3,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 4,
            'question' => "Quel est son prénom ?",
            'reponse1' => "Marcel",
            'reponse2' => "Julien",
            'reponse3' => "Régis",
            'reponse4' => "Aboubakar",
            'reponse' => 1,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 4,
            'question' => "Quel est le nom de son dernier album ?",
            'reponse1' => "Du mieux que j'ai pu",
            'reponse2' => "Wesh Enfoiré",
            'reponse3' => "G-31",
            'reponse4' => "Cri des momes",
            'reponse' => 1,
            'difficulte' => ""

        ]);

        /*LAYLOW*/

        DB::table('quizs')->insert([
            'rappeur_id'  => 6,
            'question' => "Avec quel artiste, n'a t-il jamais featé? ",
            'reponse1' => "Dinos",
            'reponse2' => "Wit",
            'reponse3' => "Les Alchimistes" ,
            'reponse4' => "Kekra",
            'reponse' => 4,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 6,
            'question' => "Dans lequel de ses clips sortit en 2016, peut-t-on voir une voiture avec des leds?",
            'reponse1' => "Oto",
            'reponse2' => "Lime",
            'reponse3' => "Toyotarola",
            'reponse4' => "Y2",
            'reponse' => 2,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 6,
            'question' => "Quel est le nom de son dernier album ?",
            'reponse1' => "L'Etrange histoire de Mr..",
            'reponse2' => "RAW-Z",
            'reponse3' => "Trinity",
            'reponse4' => "Megatron",
            'reponse' => 1,
            'difficulte' => ""

        ]);

        DB::table('quizs')->insert([
            'rappeur_id'  => 6,
            'question' => "Quel est son record de nb de ventes en premier semaine ?",
            'reponse1' => "~ 18.000",
            'reponse2' => "~ 24.000",
            'reponse3' => "~ 30.000",
            'reponse4' => "~ 35.000",
            'reponse' => 4,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 6,
            'question' => "Dans lequel de ces sons Laylow dit : 'Une saisie là ?, j'me dis qu'il saisit au moins, tenez, signez, c'est la lettre du tribunal' ?",
            'reponse1' => "'Plug'",
            'reponse2' => "'Longue vie'",
            'reponse3' => "C'est pas Laylow qui dit ca",
            'reponse4' => "'.. DE BATARD'",
            'reponse' => 3,
            'difficulte' => ""

        ]);

        /*FREEZE*/

        DB::table('quizs')->insert([
            'rappeur_id'  => 7,
            'question' => "Quel est son prénom? ",
            'reponse1' => "Issa",
            'reponse2' => "Djibril",
            'reponse3' => "Lamine" ,
            'reponse4' => "Lorenzo",
            'reponse' => 1,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 7,
            'question' => "Avec quel artiste, n'a t-il jamais featé?",
            'reponse1' => "Ashe22",
            'reponse2' => "Black Jack OBS",
            'reponse3' => "Lesram",
            'reponse4' => "La F",
            'reponse' => 3,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 7,
            'question' => "Quel est le nom de son premier VRAI album ?",
            'reponse1' => "ADC",
            'reponse2' => "LMF",
            'reponse3' => "PBB",
            'reponse4' => "Aucun des 3",
            'reponse' => 3,
            'difficulte' => ""

        ]);

        DB::table('quizs')->insert([
            'rappeur_id'  => 7,
            'question' => "Qui entend-on dans l'intro du son 'Ancelotti' ?",
            'reponse1' => "Marie-Aline Meliyi",
            'reponse2' => "Gerald Darmanin",
            'reponse3' => "Rachida Dati",
            'reponse4' => "Roselyne Bachelot",
            'reponse' => 4,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 7,
            'question' => "Comment s'intitule le son enchainant théorie du complot sur théorie du complot ?",
            'reponse1' => "Lester",
            'reponse2' => "Sacrfice de Masse",
            'reponse3' => "Argent noir pt.3",
            'reponse4' => "S/o Congo pt.2",
            'reponse' => 2,
            'difficulte' => ""

        ]); 

                /*ROROLAMEUTE*/

        DB::table('quizs')->insert([
            'rappeur_id'  => 3,
            'question' => "Quel influenceur celebre peut-on voir dans un de ses clips? ",
            'reponse1' => "Vargas",
            'reponse2' => "Nasdas",
            'reponse3' => "Bengous" ,
            'reponse4' => "Mortadon",
            'reponse' => 2,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 3,
            'question' => "Quel est le nom du son joué ici?",
            'reponse1' => "Benef",
            'reponse2' => "7/7",
            'reponse3' => "Train de vie",
            'reponse4' => "Toute la nuit",
            'reponse' => 3,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 3,
            'question' => "Quel est son morceau le plus streamé sur Spotify?",
            'reponse1' => "S'lever tot",
            'reponse2' => "Il m'en faut plus",
            'reponse3' => "On vient d'en bas",
            'reponse4' => "La Chienneté",
            'reponse' => 1,
            'difficulte' => ""

        ]);

        DB::table('quizs')->insert([
            'rappeur_id'  => 3,
            'question' => "Combien de featuring a t-il realisé?",
            'reponse1' => "3",
            'reponse2' => "2",
            'reponse3' => "1",
            'reponse4' => "0",
            'reponse' => 4,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 3,
            'question' => "Comment s'appelle sa série de freestyle?",
            'reponse1' => "Les crocs",
            'reponse2' => "Côtépass",
            'reponse3' => "La Meute",
            'reponse4' => "Freestyle Sauvage",
            'reponse' => 3,
            'difficulte' => ""

        ]);

        /*HOUDI*/

        DB::table('quizs')->insert([
            'rappeur_id'  => 1,
            'question' => "Dans quel clip peut-on voir 4 personnes rapper au tour d'une table? Et combien de sons a-t-il posé? ",
            'reponse1' => "Grhunt #77 / 3",
            'reponse2' => "Nuketown / 3",
            'reponse3' => "Grhunt #77 / 4" ,
            'reponse4' => "Nuketown / 4",
            'reponse' => 3,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 1,
            'question' => "Avec quel rappeur n'a t-il jamais featé?",
            'reponse1' => "Lesram",
            'reponse2' => "Guy2bezbar",
            'reponse3' => "34murphy",
            'reponse4' => "Aucun d'eux",
            'reponse' => 4,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 1,
            'question' => "Est-il deja passé dans l'emission 'ZEN'?",
            'reponse1' => "Non, mais il a été cité lors de l'emission",
            'reponse2' => "Non",
            'reponse3' => "Oui et il a deja fait un feat avec Grim",
            'reponse4' => "Oui, ",
            'reponse' => 1,
            'difficulte' => ""

        ]);

        DB::table('quizs')->insert([
            'rappeur_id'  => 1,
            'question' => "Dans quel son dit-il ? :'Le démon a pitié d'eux, il m'chuchote : 'laisse les vivre' ",
            'reponse1' => "7734",
            'reponse2' => "Dérapages",
            'reponse3' => "Woka",
            'reponse4' => "Pile ou face",
            'reponse' => 1,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 1,
            'question' => "Quel est son clip le plus réussi visuellement? Completement objectif (non, c faux)",
            'reponse1' => "Mode Hardcore",
            'reponse2' => "Belle chanson",
            'reponse3' => "Monaco",
            'reponse4' => "Sensation",
            'reponse' => 2,
            'difficulte' => ""

        ]);        
        


        /*i300*/

        DB::table('quizs')->insert([
            'rappeur_id'  => 2,
            'question' => "De quelle ville sont-ils originaires? ",
            'reponse1' => "Nanterre",
            'reponse2' => "Levallois Peret",
            'reponse3' => "Grigny" ,
            'reponse4' => "Corbeil",
            'reponse' => 2,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 2,
            'question' => "De quel son est extrait cette phase : 'J’fume la tookah la tête qui tourne'",
            'reponse1' => "Impliqué",
            'reponse2' => "B1",
            'reponse3' => "Amen",
            'reponse4' => "Tours",
            'reponse' => 4,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 2,
            'question' => "Un des 2 rappeurs porte le nom d'un célébre dirigeant, lequel?",
            'reponse1' => "Staline",
            'reponse2' => "Berlusconi",
            'reponse3' => "Franco",
            'reponse4' => "Fidel Castro, ",
            'reponse' => 1,
            'difficulte' => ""

        ]);

        DB::table('quizs')->insert([
            'rappeur_id'  => 2,
            'question' => "Quel est le morceau joué sur cette page ?",
            'reponse1' => "Amen",
            'reponse2' => "Call Of",
            'reponse3' => "Scam",
            'reponse4' => "Douleur des halls",
            'reponse' => 2,
            'difficulte' => ""

        ]);
        DB::table('quizs')->insert([
            'rappeur_id'  => 2,
            'question' => "Quel a est leur premier morceau ? ",
            'reponse1' => "Pas de CDI",
            'reponse2' => "Makavelik",
            'reponse3' => "Block opposé",
            'reponse4' => "Flingues & Voix",
            'reponse' => 2,
            'difficulte' => ""

        ]);  


                /*TIF*/

                DB::table('quizs')->insert([
                    'rappeur_id'  => 8,
                    'question' => "De quelle origine est-il ? ",
                    'reponse1' => "Brésilien",
                    'reponse2' => "Egyptien",
                    'reponse3' => "Marocain" ,
                    'reponse4' => "Algérien",
                    'reponse' => 4,
                    'difficulte' => ""

                ]);
                DB::table('quizs')->insert([
                    'rappeur_id'  => 8,
                    'question' => "Lequel de ces morceaux solo est-il le plus populaire ?",
                    'reponse1' => ".38",
                    'reponse2' => "La nuit",
                    'reponse3' => "Hinata",
                    'reponse4' => "Shadow Boxing",
                    'reponse' => 3,
                    'difficulte' => ""

                ]);
                DB::table('quizs')->insert([
                    'rappeur_id'  => 8,
                    'question' => "Dans quel clip, peut-on voir un laboratoire ?",
                    'reponse1' => "Shadow Boxing,",
                    'reponse2' => "Hinata",
                    'reponse3' => "BZMOR",
                    'reponse4' => "Amnesia",
                    'reponse' => 1,
                    'difficulte' => ""

                ]);
        
                DB::table('quizs')->insert([
                    'rappeur_id'  => 8,
                    'question' => "",
                    'reponse1' => "",
                    'reponse2' => "",
                    'reponse3' => "",
                    'reponse4' => "",
                    'reponse' => 4,
                    'difficulte' => ""

                ]);

                DB::table('quizs')->insert([
                    'rappeur_id'  => 8,
                    'question' => "Avec lequel de ces rappeurs a-t-il deja featé ?",
                    'reponse1' => "Soolking",
                    'reponse2' => "Luidji",
                    'reponse3' => "Rim-K",
                    'reponse4' => "Khali",
                    'reponse' => 3,
                    'difficulte' => ""

                ]);  
        
        
        /*QUIZZ GENERAL*/

        DB::table('quizs')->insert([
            'question' => "FACILE",
            'reponse1' => "FACILE",
            'reponse2' => "FACILE",
            'reponse3' => "FACILE",
            'reponse4' => "FACILE",
            'reponse' => 3,
            'difficulte' => "facile"
        ]);  

        DB::table('quizs')->insert([
            'question' => "MOYEN",
            'reponse1' => "MOYEN",
            'reponse2' => "MOYEN",
            'reponse3' => "MOYEN",
            'reponse4' => "MOYEN",
            'reponse' => 1,
            'difficulte' => "moyen"
        ]);  

        DB::table('quizs')->insert([
            'question' => "HARD",
            'reponse1' => "HARD",
            'reponse2' => "HARD",
            'reponse3' => "HARD",
            'reponse4' => "HARD",
            'reponse' => 4,
            'difficulte' => "difficile"
        ]);  

    }

    
}
