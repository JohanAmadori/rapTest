<?php

return [
    /*
    |--------------------------------------------------------------------------
    | rappeurs' Table
    |--------------------------------------------------------------------------
    |
    | The table name used to store rappeurs'
    | The primary key used
    |
    | Defaults:
    | -- table: rappeurs
    | -- primary key: rappeurs_id
    |
    */
    'rappeurs' => [
        'table' => 'rappeurs',
        'primary_key' => 'rappeurs_id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Max Rating
    |--------------------------------------------------------------------------
    |
    | The maximum rating a Model can be rated.
    |
    */
    'max_rating' => 10,

    /*
    |--------------------------------------------------------------------------
    | Undo Rating
    |--------------------------------------------------------------------------
    |
    | Whether or not a User can undo their rating.
    |
    */
    'undo_rating' => true,
];
