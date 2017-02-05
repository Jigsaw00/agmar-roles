<?php

namespace Agmar\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{   
    /**
     * Set up relation
     * @return Illuminate\Database\Eloquent\Model;
     */
    public function permissions(){
        return $this->belongsToMany(\Agmar\Role\Models\Permission ::class,'roles_permissions')->withTimestamps();
    }
}
