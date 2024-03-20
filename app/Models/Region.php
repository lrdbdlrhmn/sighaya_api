<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 *
 * @property $id
 * @property $name
 * @property $name_fr
 * @property $description
 * @property $status
 * @property $city_id
 * @property $state_id
 * @property $created_at
 * @property $updated_at
 *
 * @property City $city
 * @property State $state
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Region extends Model
{
    
    static $rules = [
		'name' => 'required',
		'name_fr' => 'required',
		'description' => 'required',
		'status' => 'required',
		'city_id' => 'required',
		'state_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','name_fr','description','status','city_id','state_id'];


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
    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'region_id', 'id');
    }
    

}
