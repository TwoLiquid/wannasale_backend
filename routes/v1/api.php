<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'domain' => '{vendorSlug}.' . config('app.domain'),
    'middleware' => 'dashboard.vendorSubdomain'
], function () {

    Route::group(['prefix' => 'api/v1', 'namespace' => 'Api\V1'], function() {

        Route::get('cookies',  'MainController@initCookies')->name('api.v1.widget.cookies');

        Route::group(['middleware' => 'api.widget'], function() {
            Route::post('displayWidget',    'MainController@displayWidget'      )->name('api.v1.widget.display');
            Route::post('setWidgetRequest', 'MainController@setWidgetRequest'   )->name('api.v1.widget.request');
            Route::post('setWidgetOpen',    'MainController@setWidgetOpen'      )->name('api.v1.widget.open');
        });
    });
});