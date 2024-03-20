<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * Class User
 *
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $phone
 * @property $nni
 * @property $user_type
 * @property $email
 * @property $whatsapp
 * @property $email_verified_at
 * @property $password
 * @property $city_id
 * @property $state_id
 * @property $region_id
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 * @property $notification_id
 *
 * @property City $city
 * @property Region $region
 * @property Report[] $reports
 * @property State $state
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    use HasFactory ,Notifiable ,HasApiTokens;
    
    static $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
		'nni' => 'required',
		'user_type' => 'required',
		'email' => 'required',
		'whatsapp' => 'required',
		'city_id' => 'required',
		'state_id' => 'required',
		'region_id' => 'required',
        'phone' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','phone','nni','user_type','email','whatsapp','city_id','state_id','region_id','password','notification_id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  public function technical(){
        return 'technical' == $user_typ;
  }
  public function manager_user(){
    return 'manager' == $user_type;
}
public function user(){
    return 'user' == $user_type;
}

public function manager()
{
    if (!$this->technical()) {
        # code...
        return;
    }
    return User::where('id','technical');
      # code...
}
  
  public function technicals()
  {
      return User::where('user_type','technical')->where('manager_id',$id);
      # code...
  }

    public function manager_reports()
    {
        return Report::where('manager_id',$id);
        # code...
    }
    public function technical_reports()
    {
        return Report::where('technical_id',$id);
        # code...
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany('App\Models\Report', 'user_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
    

}
