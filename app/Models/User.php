<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait; // add this trait to your user model


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute($value){

        return ucfirst($value);
    }

    public function scopeWhenSearch($query,$search){
        return $query->when($search,function ($q) use($search){
            return $q->where('name','like',"%$search%");
        });

    }
    public function scopeSearchRole($query,$role_name){

        return $query->when($role_name ,function($qr) use($role_name){
            return $qr->wherehas('roles',function($q) use($role_name){
            return $q->where('name',$role_name);
        });
    });
    }
    public function scopeSearchRoleNot($query,$role_name){

        return $query->when($role_name ,function($qr) use($role_name){
            return $qr->wherehas('roles',function($q) use($role_name){
            return $q->whereNotin('name',(array)$role_name);
        });
    });
    }
}
