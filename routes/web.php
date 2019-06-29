<?php

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setlocale'
],
    function () {

        Route::get('/', 'HomeController@index')->name('home');



        Auth::routes();
        Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');
        Route::group(
            [
                'prefix' => 'cabinet',
                'as' => 'cabinet.',
                'namespace' => 'Cabinet',
                'middleware' => ['auth'],
            ],
            function () {
                Route::get('/', 'HomeController@index')->name('home');
            }
        );

        Route::group(
            [
                'prefix' => 'admin',
                'as' => 'admin.',
                'namespace' => 'Admin',
                'middleware' => ['auth', 'can:admin.panel'],
            ],
            function () {
                Route::get('/', 'HomeController@index')->name('home');
                Route::resource('user', 'UserController');
                Route::patch('user/verify/{user}', 'UserController@verify')->name('user.verify');
            }
        );
    }
);



