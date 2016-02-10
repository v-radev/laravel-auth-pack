<?php namespace App\Clusters\AuthCluster\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot( Router $router )
    {
        if ( !$this->app->routesAreCached() ) {
            require realpath( base_path( 'app/Clusters/AuthCluster/Resources/auth_cluster_routes.php' ) );
        }

        $router->bind( 'userName', function ( $username ) {
            return \App\Clusters\AuthCluster\Models\User::whereUsername( $username )->firstOrFail();
        } );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
