<?php

namespace Agmar\Role\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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
    public function permissions(){
        return $this->belongsToMany(\Agmar\Role\Models\Permission ::class,'roles_permissions')->withTimestamps();
    }
}
