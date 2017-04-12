<?php

namespace Agmar\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    protected $fillable = [
       'name',
       'created_at',
       'updated_at'
    ];

    /**
     * Set up relation
     * @return Illuminate\Database\Eloquent\Model;
     */
    public function roles(){
        return $this->belongsToMany(\Agmar\Role\Models\Role::class,'roles_permissions')->withTimestamps();
    }
}
