<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class VehicleOperator extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'vehicle_operators';
    protected $primaryKey = 'operator_id';
    protected $fillable = [
        'name', 'phone_number', 'email', 'route', 'owner_id', 'vehicle_id'
    ];
    protected static $logAttributes = ['name', 'email', 'owner_id'];

    public function getNameAttribute($value){
        return ucwords($value);
    }

    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }

    public function getEmailAttribute($value){
        return $value;
    }

    public function setEmailAttribute($value){
        return $this->attributes['email'] = $value;
    }

    public function getRouteAttribute($value){
        return ucwords($value);
    }

    public function setRouteAttribute($value){
        return $this->attributes['route'] = ucwords($value);
    }
    public function getVehicleIdAttribute($value){
        return ($value);
    }

    public function setVehicleIdAttribute($value){
        return $this->attributes['vehicle_id'] = ($value);
    }

    public function getPhoneNumberAttribute($value){
        return ($value);
    }

    public function setPhoneNumberAttribute($value){
        return $this->attributes['phone_number'] = ($value);
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

    public function vehicles(){
        return $this->hasMany('App\Vehicle','vehicle_id');
    }
    public function cars(){
        return $this->belongsTo('App\Vehicle','vehicle_id');
    }

    // public function owner(){
    //     return $this->belongsTo('App\VehicleOwner', 'owner_id');
    // }
}
