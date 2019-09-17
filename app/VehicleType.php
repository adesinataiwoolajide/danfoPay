<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VehicleType extends Model
{
    use SoftDeletes;

    protected $table = 'vehicle_types';
    protected $primaryKey = 'type_id';
    protected $fillable = [
        'type_name',
    ];

    public function getTypeNameAttribute($value){
        return ucwords($value);
    }

    public function setTypeNameAttribute($value){
        return $this->attributes['type_name'] = ucwords($value);
    }

    public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getDeletedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getUpdatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function vehicle(){
        return $this->hasMany('App\Vehicle','vehicle_id', 'type_id');
    }
}
