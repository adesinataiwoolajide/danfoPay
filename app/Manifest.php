<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class Manifest extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'manifests';
    protected $primaryKey = 'manifest_id';

    protected $fillable = [
        'vehicle_id', 'customer_id', 'amount','negotiation_id'
    ];

    protected static $logAttributes = ['vehicle_id', 'customer_id', 'amount'];

    public function getVehicleIdAttribute($value){
        return ($value);
    }

    public function setVehicleIdAttribute($value){
        return $this->attributes['vehicle_id'] = ($value);
    }
    public function getNegotiationIdAttribute($value){
        return ($value);
    }

    public function setNegotiationIdAttribute($value){
        return $this->attributes['negotiation_id'] = ($value);
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

    public function cos(){
        return $this->belongsTo('App\Customer','customer_id');
    }
    public function nego(){
        return $this->belongsTo('App\Negotiation','negotiation_id');
    }

    public function oko(){
        return $this->belongsTo('App\Vehicle', 'owner_id');
    }

}
