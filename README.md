### Requirements:
```
php: >=5.5.9
laravel/framework: 5.1.*
```

___

### Installation


- Make sure Cache is enabled and you have a valid working cache driver
- Install laracasts/flash composer package
- Install laravelcollective/html composer package
- In RouteServiceProvider@boot add:
```
$router->bind('userName', function ($username) {
    return \App\Clusters\AuthCluster\Models\User::whereUsername($username)->firstOrFail();
});

if ( !$this->app->routesAreCached() ) {
        require realpath(base_path('app/Clusters/AuthCluster/routes.php'));
}
```
- In App/Http/Kernel add:
```
protected $routeMiddleware = [
    'auth.basic'       => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
    'only.logged'      => \App\Http\Middleware\Authenticate::class,
    'only.guests'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'only.permission'  => \App\Clusters\AuthCluster\Middleware\AccessControl\VerifyUserHasPermission::class,
    'access.profile'   => \App\Clusters\AuthCluster\Middleware\AccessControl\VerifyUserProfileAccess::class,
    'access.dashboard' => \App\Clusters\AuthCluster\Middleware\AccessControl\VerifyDashboardAccess::class,
];
```

- In config/auth.php set 'model' => App\Clusters\AuthCluster\Models\User::class,
- In config/view.php add realpath(base_path('app/Clusters/AuthCluster/Resources/views')), to 'paths' => []
- Delete default user and password reset migrations and run 
```
php artisan migrate --path=/app/Clusters/AuthCluster/Resources/Database/migrations
```

- Add seeds to DB Seeder
```
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\RolesTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\PermissionsTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\UsersTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\RolesPermissionsTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\UsersRolesTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\UsersRolesPermissionsTableSeeder::class);
```

- Run aritsan db:seed
- Customize the default password reset template in resources/views/emails/password.blade.php or copy the one from 
```
AuthCluster/Resources/views/authcluster/emails/password.blade.php
```
- Copy AuthCluster/Resources/js and AuthCluster/Resources/css into public/
