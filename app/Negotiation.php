<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Negotiation extends Model
{
    use SoftDeletes;

    protected $table = 'negotiations';
    protected $primaryKey = 'negotiation_id';

    protected $fillable = [
        'vehicle_id', 'from_destination', 'to_destination', 'amount', 'customer_id', 'status',
    ];

    public function getVehicleIdAttribute($value){
        return ($value);
    }

    public function setVehicleIdAttribute($value){
        return $this->attributes['vehicle_id'] = ($value);
    }

    public function getFromDestinationAttribute($value){
        return ($value);
    }

    public function setFromDestinationAttribute($value){
        return $this->attributes['from_destination'] = ($value);
    }
    public function getToDestinationAttribute($value){
        return ($value);
    }

    public function setToDestinationAttribute($value){
        return $this->attributes['to_destination'] = ($value);
    }

    public function getAmountAttribute($value){
        return ($value);
    }

    public function setAmountAttribute($value){
        return $this->attributes['amount'] = ($value);
    }

    public function getCustomerIdAttribute($value){
        return ($value);
    }

    public function setCustomerIdAttribute($value){
        return $this->attributes['customer_id'] = ($value);
    }

    public function getStatusAttribute($value){
        return ($value);
    }

    public function setStatusAttribute($value){
        return $this->attributes['status'] = ($value);
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

    public function car(){
        return $this->belongsTo('App\Vehicle','vehicle_id');
    }
    public function custo(){
        return $this->belongsTo('App\Customer','customer_id');
    }

    public function man(){
        return $this->hasMany('App\Manifest', 'manifest_id', 'negotiation_id');
    }

}
