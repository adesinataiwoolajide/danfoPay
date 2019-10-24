<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class Customer extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'name', 'email', 'phone_number', 'customer_number',
    ];
    protected static $logAttributes = ['name', 'email', 'customer_number'];

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

    public function getPhoneNumberAttribute($value){
        return ucwords($value);
    }

    public function setPhoneNumberAttribute($value){
        return $this->attributes['phone_number'] =($value);
    }

    public function getCustomerNumberAttribute($value){
        return $value;
    }

    public function setCustomerNumberAttribute($value){
        return $this->attributes['customer_number'] = $value;
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

    public function negotiation(){
        return $this->hasMany('App\Negotiation', 'negotiation_id', 'customer_id');
    }

}
