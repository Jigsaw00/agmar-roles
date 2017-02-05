<?php

namespace Agmar\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Set up Relation
     * @return Illuminate\Database\Eloquent\Model;
     */
    public function roles(){
        return $this->belongsToMany(\Agmar\Role\Models\Role::class,'roles_permissions')->withTimestamps();
    }
}
