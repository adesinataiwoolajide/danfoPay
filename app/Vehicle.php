<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class Vehicle extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'vehicles';
    protected $primaryKey = 'vehicle_id';
    protected $fillable = [
        'plate_number', 'brand', 'type_id', 'owner_id', 'vehicle_number'
    ];

    protected static $logAttributes = ['plate_number', 'owner_id', 'vehicle_number', 'type_id'];

    public function getBrandAttribute($value){
        return strtoupper($value);
    }

    public function setBrandAttribute($value){
        return $this->attributes['brand'] = strtoupper($value);
    }
    public function getVehicleNumberAttribute($value){
        return strtoupper($value);
    }

    public function setVehicleNumberAttribute($value){
        return $this->attributes['vehicle_number'] = strtoupper($value);
    }

    public function getPlateNumberAttribute($value){
        return strtoupper($value);
    }

    public function setPlateNumberAttribute($value){
        return $this->attributes['plate_number'] = strtoupper($value);
    }

    public function getTypeIdAttribute($value){
        return ($value);
    }

    public function setTypeIdAttribute($value){
        return $this->attributes['type_id'] = ($value);
    }
    public function getOwnerIdAttribute($value){
        return ($value);
    }

    public function setOwnerIdAttribute($value){
        return $this->attributes['owner_id'] = ($value);
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

    public function type(){
        return $this->belongsTo('App\VehicleType', 'type_id');
    }
    public function owner(){
        return $this->belongsTo('App\VehicleOwner', 'owner_id');
    }

    public function operator(){
        return $this->hasMany('App\VehicleOperator', 'operator_id', 'vehicle_id');
    }
    public function negotiate(){
        return $this->hasMany('App\Negotiation', 'negotiation_id', 'vehicle_id');
    }


    public function mani(){
        return $this->hasMany('App\Manivest', 'manifest_id', 'vehicle_id');
    }
    public function rounds(){
        return $this->hasOne('App\Rounds', 'round_id', 'vehicle_id');
    }
    // public function operator(){
    //     return $this->hasMany('App\VehicleOperator', 'operator_id', 'vehicle_id');
    // }
}
