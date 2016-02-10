<?php namespace App\Clusters\AuthCluster\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $clusterViewsNamespace = config( 'authcluster.views_name_space' );

        $this->loadViewsFrom( realpath( base_path( 'app/Clusters/AuthCluster/Resources/views' ) ), $clusterViewsNamespace );

        view()->share( 'authViews', $clusterViewsNamespace . '::' );
        view()->share( 'authLoginRoutes', config( 'authcluster.login_name_space' ) . '.' );
        view()->share( 'authDashboardRoutes', config( 'authcluster.dashboard_routes_prefix' ) . '.' );
        view()->share( 'authProfileRoutes', config( 'authcluster.profiles_routes_prefix' ) . '.' );
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
