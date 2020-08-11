<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root routes
Route::group(['domain' => config('app.domain')], function () {

    Route::get('/', 'Front\MainController@home')->name('home');
});

Route::group([
    'domain' => 'register.' . config('app.domain'),
    'namespace' => 'Front'
], function () {
    Route::get('/',  'AuthController@registerView')->name('register');
    Route::post('/', 'AuthController@registerMake')->name('register.make');
});

Route::get('registration/confirm',  'Dashboard\AuthController@confirmEmail'       )->name('dashboard.registration.confirm');

// Dashboard
Route::group([
    'domain' => '{vendorSlug}.' . config('app.domain'),
    'namespace' => 'Dashboard',
    'middleware' => 'dashboard.vendorSubdomain'
], function () {

    Route::group(['middleware' => 'guest:' . GUARD_DASHBOARD], function () {

        Route::get('login',  'AuthController@login'       )->name('dashboard.login');
        Route::post('login', 'AuthController@authenticate')->name('dashboard.login.make');
    });

    Route::group(['middleware' => ['auth:' . GUARD_DASHBOARD, 'dashboard.vendorAccess']], function () {

        Route::group(['middleware' => ['dashboard.vendorPayment']], function () {

            Route::get('/',      'MainController@home'  )->name('dashboard.home');
            Route::get('logout', 'AuthController@logout')->name('dashboard.logout');

            Route::group(['prefix' => 'sites'], function () {

                Route::get('/',              'SitesController@index' )->name('dashboard.sites');
                Route::get('create',         'SitesController@create')->name('dashboard.sites.create');
                Route::post('create',        'SitesController@store' )->name('dashboard.sites.store');
                Route::get('{uuid}',         'SitesController@view'  )->name('dashboard.sites.view');
                Route::post('{uuid}/edit',   'SitesController@update')->name('dashboard.sites.update');
                Route::post('{uuid}/delete', 'SitesController@delete')->name('dashboard.sites.delete');

                Route::get('{uuid}/items/excel/import', 'SitesController@excel')->name('dashboard.sites.items.excel');
                Route::post('{uuid}/items/excel/import', 'SitesController@excelImport')->name('dashboard.sites.items.excel.import');

                Route::get('{uuid}/items',        'ItemsController@index' )->name('dashboard.items');
                Route::get('{uuid}/items/create', 'ItemsController@create')->name('dashboard.items.create');
                Route::post('{uuid}/items/create','ItemsController@store' )->name('dashboard.items.store');

                Route::post('{uuid}/widget/update/settings', 'WidgetController@updateSettings')->name('dashboard.widgets.settings');
                Route::post('{uuid}/widget/update/position', 'WidgetController@updatePosition')->name('dashboard.widgets.position');
                Route::post('{uuid}/widget/update/button',   'WidgetController@updateButtonSettings')->name('dashboard.widgets.button.settings');
                Route::post('{uuid}/widget/update/window',   'WidgetController@updateWindowSettings')->name('dashboard.widgets.window.settings');
                Route::post('{uuid}/widget/update/message',  'WidgetController@updateWindowMessage')->name('dashboard.widgets.window.message');

                Route::post('{uuid}/widget/fields/create',   'WidgetController@createCustomField')->name('dashboard.widgets.fields.create');
                Route::post('{uuid}/widget/fields/delete',   'WidgetController@deleteCustomField')->name('dashboard.widgets.fields.delete');
            });

            Route::group(['prefix' => 'items'], function () {

                Route::get('{uuid}/edit',   'ItemsController@edit'  )->name('dashboard.items.edit');
                Route::post('{uuid}/edit',  'ItemsController@update')->name('dashboard.items.update');
                Route::post('{uuid}/delete','ItemsController@delete')->name('dashboard.items.delete');
            });

            Route::group(['prefix' => 'clients'], function () {

                Route::get('/',                      'ClientsController@index'        )->name('dashboard.clients');
                Route::get('create',          'ClientsController@create'       )->name('dashboard.clients.create');
                Route::post('create',         'ClientsController@store'        )->name('dashboard.clients.store');
                Route::get('{uuid}/similar',         'ClientsController@getSimilar'   )->name('dashboard.clients.similar');
                Route::post('{uuid}/similar/update', 'ClientsController@updateSimilar')->name('dashboard.clients.similar.update');
                Route::post('{uuid}/delete',         'ClientsController@delete'       )->name('dashboard.clients.delete');

                Route::get('excel',         'ClientsController@excel'       )->name('dashboard.clients.excel');
            });

            Route::group(['prefix' => 'requests'], function () {

                Route::get('/',                         'RequestsController@index'       )->name('dashboard.requests');
                Route::get('create',                    'RequestsController@create'      )->name('dashboard.requests.create');
                Route::post('create',                   'RequestsController@store'       )->name('dashboard.requests.store');
                Route::get('{uuid}',                    'RequestsController@view'        )->name('dashboard.requests.view');
                Route::post('{uuid}',                   'RequestsController@update'      )->name('dashboard.requests.update');
                Route::post('{uuid}/delete',            'RequestsController@delete'      )->name('dashboard.requests.delete');
                Route::get('{uuid}/messages',           'RequestsController@messages'    )->name('dashboard.requests.messages');
                Route::post('{uuid}/messages/send',     'RequestsController@sendMessage')->name('dashboard.requests.messages.send');

                Route::post('site/data/get',     'RequestsController@getSiteRelatedData')->name('dashboard.requests.site.data.get');

                Route::post('{uuid}/messages/get',      'RequestsController@updateClientMessages')->name('dashboard.requests.messages.get');
                Route::post('{uuid}/messages/price/set','RequestsController@setMessagePrice')->name('dashboard.requests.messages.price.set');
            });

            Route::group(['prefix' => 'settings'], function () {

                Route::get('/',             'SettingsController@index')->name('dashboard.settings');
                Route::post('info/update',  'SettingsController@saveInfo')->name('dashboard.settings.info.update');

                Route::get( 'users/create',      'UserController@createUser')->name('dashboard.settings.users.create');
                Route::post('users/invite',     'UserController@inviteUser')->name('dashboard.settings.users.invite');
                Route::post('users/{id}/delete','UserController@delete'    )->name('dashboard.settings.users.delete');
            });

            Route::group(['prefix' => 'transactions'], function () {

                Route::get('/', 'TransactionController@index'     )->name('dashboard.transactions');
            });
        });

        Route::group(['prefix' => 'subscription'], function () {

            Route::get('/',         'SubscriptionController@index'    )->name('dashboard.subscription');
            Route::get('create',    'SubscriptionController@create'   )->name('dashboard.subscription.create');
            Route::post('store',    'SubscriptionController@store'    )->name('dashboard.subscription.store');
            Route::post('/',        'SubscriptionController@subscribe')->name('dashboard.subscription.subscribe');
            Route::get('disabled',  'SubscriptionController@disabled' )->name('dashboard.subscription.disabled');
        });

        Route::group(['prefix' => 'cards'], function () {

            Route::get('/',                     'CardController@index'       )->name('dashboard.cards');
            Route::get('create',                'CardController@create'      )->name('dashboard.cards.create');
            Route::post('{uuid}/delete',        'CardController@delete'      )->name('dashboard.cards.delete');

            Route::post('attach',               'CardController@attach'      )->name('dashboard.cards.attach');
            Route::post('attach/confirm3DS',    'CardController@confirm3DS'  )->name('dashboard.cards.attach.confirm3DS');
        });

    });
});
