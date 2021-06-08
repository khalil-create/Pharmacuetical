<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_name_third','user_surname','user_type','sex','birthdate','birthplace',
        'town','village','email','phone_number','identity_type','identity_number','user_image', 'password',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'remember_token',
        'password',
    ];
    public function supervisor()
    {
        return $this->hasMany('App\Models\Supervisor','user_id','id');//(related,foriegn key,primary key)
    }
    public function representatives()
    {
        return $this->hasMany('App\Models\Representative','user_id','id');//(related,foriegn key,primary key)
    }
    public function manager()
    {
        return $this->hasOne('App\Models\Manager','user_id','id');//(related,foriegn key,primary key)
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
