<?php

$routesNamespace = config( 'authcluster.login_name_space' ) . '.';
$dashboardNamespace = config( 'authcluster.dashboard_name_space' ) . '.';
$profiledNamespace = config( 'authcluster.profiles_name_space' ) . '.';
$loginRoutesPrefix = config( 'authcluster.login_routes_prefix' );
$dashboardRoutesPrefix = config( 'authcluster.dashboard_routes_prefix' );
$profileRoutesPrefix = config( 'authcluster.profiles_routes_prefix' );


//For codeception coverage
Route::any( '/c3.php', function () {
    require_once base_path() . '/public/index.php';
    require_once base_path() . '/vendor/autoload.php';
    require_once base_path( 'c3.php' );
} );

//For codeception coverage
Route::any( '/c3.php/{extra}', function () {
    require_once base_path() . '/public/index.php';
    require_once base_path() . '/vendor/autoload.php';
    require_once base_path( 'c3.php' );
} )->where( 'extra', '.*' );


Route::group( [ 'prefix' => $loginRoutesPrefix ], function () use ( $routesNamespace ) {
//Authentication
    Route::get( 'login', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@getLogin', 'as' => $routesNamespace . 'login' ] );
    Route::post( 'login', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@postLogin', 'as' => $routesNamespace . 'login' ] );
    Route::get( 'logout', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@getLogout', 'as' => $routesNamespace . 'logout' ] );
//Password reset
    Route::get( 'password', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@getEmail', 'as' => $routesNamespace . 'password' ] );
    Route::post( 'password', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@postEmail', 'as' => $routesNamespace . 'password' ] );
    Route::get( 'reset/{token}', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@getReset', 'as' => $routesNamespace . 'reset' ] );
    Route::post( 'reset', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\PasswordController@postReset', 'as' => $routesNamespace . 'reset' ] );
//Registration
    Route::get( 'register', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@getRegister', 'as' => $routesNamespace . 'register' ] );
    Route::post( 'register', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\AuthController@postRegister', 'as' => $routesNamespace . 'register' ] );
} );


//Admin dashboard
Route::group( [ 'prefix' => $dashboardRoutesPrefix, 'middleware' => 'access.dashboard' ], function () use ( $dashboardNamespace ) {
    Route::any( 'ajax', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\Dashboard\DashboardController@ajax', 'as' => $dashboardNamespace . 'ajax' ] );
//Dashboard users
    Route::resource( 'users', 'App\Clusters\AuthCluster\Controllers\Dashboard\UsersController', [
        'except' => [ 'create', 'store', 'show' ],
        'names'  =>
            [
                'index'   => $dashboardNamespace . 'users.index',
                'edit'    => $dashboardNamespace . 'users.edit',
                'update'  => $dashboardNamespace . 'users.update',
                'destroy' => $dashboardNamespace . 'users.destroy',
            ],
    ] );
} );

Route::get( $profileRoutesPrefix . '/{userName}', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\ProfileController@show', 'as' => $profiledNamespace . 'show' ] );
Route::get( $profileRoutesPrefix . '/{userName}/edit', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\ProfileController@edit', 'as' => $profiledNamespace . 'edit' ] );
Route::put( $profileRoutesPrefix . '/{userName}', [ 'uses' => 'App\Clusters\AuthCluster\Controllers\User\ProfileController@update', 'as' => $profiledNamespace . 'update' ] );
