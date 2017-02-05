<?php

namespace Agmar\Role;

use Illuminate\Support\ServiceProvider;
use Agmar\Role\Models\Permission;
use Gate;
use Illuminate\Support\Facades\Blade;

class AgmarRoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        Load migrations from package directory
         */
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');


        /*
        Check if user 'can' specific permission
         */
        Permission::get()->map(function($permission){


            Gate::define($permission->name,function($user) use ($permission){

                return $user->hasPermissionTo($permission);

            });

        });

        /*
        Custom blade directives
         */

        Blade::directive('role', function($role){
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?> ";
        });

        Blade::directive('endrole', function($role){
            return '<?php endif; ?> ';
        });
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
