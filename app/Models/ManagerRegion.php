<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ManagerRegion
 *
 * @property $id
 * @property $region_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Region $region
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ManagerRegion extends Model
{
    
    static $rules = [
		'region_id' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['region_id','user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function region()
    {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
