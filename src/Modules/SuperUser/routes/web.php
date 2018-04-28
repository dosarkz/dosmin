<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => [ 'web', 'language'],
    'namespace' => 'Dosarkz\Dosmin\Modules\SuperUser\Http\Controllers'], function () {

    Route::group(['middleware' => ['guardAuth:admin', 'role:admin']], function() {
        Route::resource('superUser','SuperUserController');
    });
});