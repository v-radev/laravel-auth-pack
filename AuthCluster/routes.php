<?php

//For codeception coverage
Route::any('/c3.php', function () {
    require_once base_path() .'/public/index.php';
    require_once base_path() .'/vendor/autoload.php';
    require_once base_path('c3.php');
});

//For codeception coverage
Route::any('/c3.php/{extra}', function () {
    require_once base_path() .'/public/index.php';
    require_once base_path() .'/vendor/autoload.php';
    require_once base_path('c3.php');
})->where('extra', '.*');


Route::group(['prefix' => 'auth'], function ()
{
//Authentication
    Route::get('login', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@getLogin', 'as' => 'auth.login']);
    Route::post('login', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@postLogin', 'as' => 'auth.login']);
    Route::get('logout', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@getLogout', 'as' => 'auth.logout']);
//Password reset
    Route::get('password', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@getEmail', 'as' => 'auth.password']);
    Route::post('password', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@postEmail', 'as' => 'auth.password']);
    Route::get('reset/{token}', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@getReset', 'as' => 'auth.reset']);
    Route::post('reset', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@postReset', 'as' => 'auth.reset']);
//Registration
    Route::get('register', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@getRegister', 'as' => 'auth.register']);
    Route::post('register', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@postRegister', 'as' => 'auth.register']);
});


//Admin dashboard
Route::group(['prefix' => 'dashboard', 'middleware' => 'access.dashboard'], function ()
{
    Route::any('ajax', ['uses' => 'App\Clusters\AuthCluster\Controllers\Dashboard\DashboardController@ajax', 'as' => 'dashboard.ajax']);
//Dashboard users
    Route::resource('users', 'App\Clusters\AuthCluster\Controllers\Dashboard\UsersController', ['except' => ['create', 'store', 'show']]);
});

Route::get('profile/{userName}', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\ProfileController@show', 'as' => 'profile.show']);
Route::get('profile/{userName}/edit', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\ProfileController@edit', 'as' => 'profile.edit']);
Route::put('profile/{userName}', ['uses' => 'App\Clusters\AuthCluster\Controllers\User\ProfileController@update', 'as' => 'profile.update']);
