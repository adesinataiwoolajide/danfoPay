<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class VehicleOwner extends Model
{
    use SoftDeletes;
    use LogsActivity;
    protected $table = 'vehicle_owner';
    protected $primaryKey = 'owner_id';
    protected $fillable = [
        'name','phone_number', 'email', 'address', 'owner_number',
    ];

    protected static $logAttributes = ['name', 'email', 'owner_number'];

    public function getEmailAttribute($value){
        return $value;
    }

    public function setEmailAttribute($value){
        return $this->attributes['email'] = $value;
    }


    public function getNameAttribute($value){
        return ucwords($value);
    }

    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }

    public function getPhoneNumberAttribute($value){
        return ($value);
    }

    public function setPhoneNumberAttribute($value){
        return $this->attributes['phone_number'] = ($value);
    }

    public function getAddressAttribute($value){
        return ($value);
    }

    public function setAddressAttribute($value){
        return $this->attributes['address'] = ($value);
    }
    public function getOwnerNumberAttribute($value){
        return ($value);
    }

    public function setOwnerNumberAttribute($value){
        return $this->attributes['owner_number'] = ($value);
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
        return $this->hasMany('App\VehicleOwner','vehicle_id', 'owner_id');
    }
}
