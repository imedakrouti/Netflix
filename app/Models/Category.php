<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','image'];
    public function getNameAttribute($value){
        return ucfirst($value);
    }
    /* scoop */
    public function ScopeWhenSearch($query,$search){

        return $query->when($search,function($q) use($search){
            return $q->where('name','like',"%$search%");
        });
    }
}
