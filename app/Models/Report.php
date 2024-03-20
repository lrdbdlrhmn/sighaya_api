<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Report
 *
 * @property $id
 * @property $report_type
 * @property $latlng
 * @property $description
 * @property $status
 * @property $manager_id
 * @property $technical_id
 * @property $city_id
 * @property $state_id
 * @property $user_id
 * @property $image
 * @property $created_at
 * @property $updated_at
 *
 * @property City $city
 * @property State $state
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Report extends Model
{
    
    static $rules = [
		'report_type' => 'required',
		'latlng' => 'required',
		'description' => 'required',
		'status' => 'required',
		//'manager_id' => 'required',
		//'technical_id' => 'required',
		'city_id' => 'required',
		'state_id' => 'required',
		'user_id' => 'required',
        'region_id' => 'required',
        'image' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['report_type','region_id','image','latlng','description','status','manager_id','technical_id','city_id','state_id','user_id'];


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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
