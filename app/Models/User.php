<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name_third','user_surname','user_type','sex','birthdate','birthplace',
        'town','village','email','phone_number','identity_type','identity_number','user_image', 'password',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'remember_token',
    ];
    public function supervisor()
    {
        return $this->hasMany('App\Models\Supervisor','user_id','id');//(related,foriegn key,primary key)
    }
    // public function mainareas()
    // {
    //     return $this->hasMany('App\Models\Mainarea','supervisor_id','id');//(related,foriegn key,primary key)
    // }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
