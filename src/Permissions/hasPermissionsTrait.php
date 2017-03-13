<?php 

namespace Agmar\Role\Permissions;

use Agmar\Role\Models\Role;
use Agmar\Role\Models\Permission;

trait hasPermissionsTrait {


    /*
    Roles
    ---------------------------------------------------------------------------------
     */
    
    /**
     * Check if user has role
     * @param  array $roles
     * @return boolean        
     */
    public function hasRole($roles){

       foreach ($roles as $role) {
           if ($this->roles->contains('name',strtolower($role))) {
               return true;
           }
       }

       return false;
    }

    /**
     * Give particular role to an user
     * @param  array $roles 
     * @return this
     */
    public function giveRole($roles){
        $roles = $this->getAllRoles(array_flatten($roles));

        if($roles === null){
            return $this;
        }

        $this->roles()->saveMany($roles);

        return $this;
    }

    /**
     * Update current roles
     * @param  array $roles 
     * @return $this
     */
    public function updateRoles($roles){
        $this->roles()->detach();

        return $this->giveRole($roles);
    }

    /**
     * Withdraw given role 
     * @param  array $roles 
     * @return $this
     */
    public function withdrawRoles($roles){
        $roles = $this->getAllRoles(array_flatten($roles));

        $this->roles()->detach($roles);

        return $this;
    }

    /**
     * Get all roles
     * @param  array  $roles
     * @return Illuminate\Database\Eloquent\Model
     */
    protected function getAllRoles($roles){
        return Role::whereIn('name',$role)->get();
    }
    
    /*
    Permissions
    ---------------------------------------------------------------------------------
     */

    /**
     * Get all permissions
     * @param  array  $permissions
     * @return Illuminate\Database\Eloquent\Model
     */
    protected function getAllPermissions($permissions){
        return Permission::whereIn('name',$permissions)->get();
    }

    /**
     * Update current user permissions
     * @param  array $permissions
     * @return $this
     */
    public function updatePermissions($permissions){
        $this->permissions()->detach();

        return $this->givePermissionTo($permissions);
    }

    /**
     * Give to user specific permission
     * @param  array $permissions
     * @return $this
     */
    public function givePermissionTo($permissions){

        $permissions = $this->getAllPermissions(array_flatten($permissions)); 

        if($permissions === null){
            return $this;
        }

        $this->permissions()->saveMany($permissions);

        return $this;
        
    }

    /**
     * Withdraw specific permission
     * @param  array $permissions
     * @return $this
     */
    public function withdrawPermissionTo($permissions){
        $permissions = $this->getAllPermissions(array_flatten($permissions));

        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * Check permission through role
     * @param  $permission
     * @return boolean
     */
    protected function hasPermissionThroughRole($permission){

        foreach($permission->roles as $role){
            if($this->roles->contains($role)){
                return true;
            }
        }

        return false;

    }

    /**
     * Check if user has permission and through role
     * @param  $permission
     * @return boolean
     */
    public function hasPermissionTo($permission){
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    /**
     * @param  $permission
     * @return boolean 
     */
    
    protected function hasPermission($permission){
        return (bool) $this->permissions->where('name',$permission->name)->count();
    }

    /**
     * Set up Relation
     * @return Illuminate\Database\Eloquent\Model
     */
    public function roles(){

        return $this->belongsToMany(Role::class,'users_roles')->withTimestamps();

    }

    /**
     * Set up Relation
     * @return Illuminate\Database\Eloquent\Model
     */
    public function permissions(){

        return $this->belongsToMany(Permission::class,'users_permissions')->withTimestamps();

    }

}
