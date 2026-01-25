<?php

use Illuminate\Support\Facades\Route;

Route::get('imports', 'Backend\ImportController@index');
Route::post('imports', 'Backend\ImportController@import');


/*Route::get('pages/{slug}', 'Backend\PageController@index')->where('slug', '[a-z\-\/]+');

Route::mcResource(
    'managements/{slug}',
    'Backend\PageController',
    [
        'where' => ['slug' => '[a-z\-\/]+']
    ]
);*/
