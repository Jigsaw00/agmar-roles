# agmar-roles

Download package using:
```sh
composer require agmar/role
```
copy migrations from vendor/agmar/role/migrations to migrations folder in your application folder
run laravel migration

register the service provider:
```sh
Agmar\Role\AgmarRoleServiceProvider::class,
```
register the middleware in App\Http\Kernel.php:
```sh
'role'=>\Agmar\Role\Middleware\RoleMiddleware::class,
```

Add hasPermissionsTrait to your User model:
```sh
use Agmar\Role\Permissions\hasPermissionsTrait;
```

...and use it inside the user model
```sh
class User extends Authenticatable
{
    use hasPermissionsTrait;
}
```
