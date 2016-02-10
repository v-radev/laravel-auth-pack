### Requirements:
```
php: >= 5.5.9
laravel/framework: 5.1.*
laracasts/flash": ^1.3
laravelcollective/html": ^5.1
```

### Codeception tests coverage:
```
Classes: 94.12% (16/17)  
Methods: 91.53% (54/59) 
Location: tests/_output/coverage/
```
___

### Installation

- Make a Cluster/ folder within app/ and copy AuthCluster/ inside
- Make sure Cache is enabled and you have a valid working cache driver
- In config/app.php to the providers array add:
```
App\Clusters\AuthCluster\Providers\AuthClusterServiceProvider::class
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

- Delete default user and password reset migrations and run php artisan vendor:publish

- Add seeds to DB Seeder
```
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\RolesTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\PermissionsTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\UsersTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\RolesPermissionsTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\UsersRolesTableSeeder::class);
$this->call(App\Clusters\AuthCluster\Resources\Database\Seeds\UsersRolesPermissionsTableSeeder::class);
```

- Run php artisan migrate --seed
- Customize the default password reset template in resources/views/emails/password.blade.php or copy the one from 
```
AuthCluster/Resources/views/authcluster/emails/password.blade.php
```
