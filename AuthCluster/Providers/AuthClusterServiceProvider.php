<?php namespace App\Clusters\AuthCluster\Providers;

use Illuminate\Support\ServiceProvider;

class AuthClusterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes( [
            realpath( base_path( 'app/Clusters/AuthCluster/Resources/config.php' ) ) => config_path( 'authcluster.php' )
        ], 'config' );

        $this->publishes( [
            realpath( base_path( 'app/Clusters/AuthCluster/Resources/public' ) ) => public_path( 'vendor/authcluster' )
        ], 'public' );

        $this->publishes( [
            realpath( base_path( 'app/Clusters/AuthCluster/Resources/Database/migrations' ) ) => database_path( 'migrations' )
        ], 'migrations' );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register( RouteServiceProvider::class );
        $this->app->register( ViewServiceProvider::class );
    }
}
