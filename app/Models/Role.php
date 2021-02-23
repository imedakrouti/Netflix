<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
    protected $fillable=['name'];

     /* scoop */
     public function ScopeWhenSearch($query,$search){

        return $query->when($search,function($q) use($search){
            return $q->where('name','like',"%$search%");
        });
    }
     public function ScopeWhereNotRule($query,$role_name){

       return $query->whereNotIn('name',(array)$role_name);
    }
}
