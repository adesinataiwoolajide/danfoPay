<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payments extends Model
{
    //

    use SoftDeletes;

    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'reference', 'amount', 'user_id', 'status', 'currency'
    ];

    public function getRefrenceAttribute($value){
        return ($value);
    }

    public function setRefrenceIdAttribute($value){
        return $this->attributes['reference'] = ($value);
    }
    public function getStatusAttribute($value){
        return ($value);
    }

    public function setStatusAttribute($value){
        return $this->attributes['status'] = ($value);
    }
    public function getCurrencyAttribute($value){
        return ($value);
    }

    public function setCurrencyAttribute($value){
        return $this->attributes['currency'] = ($value);
    }
    public function getAmountAttribute($value){
        return ($value);
    }

    public function setAmountAttribute($value){
        return $this->attributes['amount'] = ($value);
    }
    public function getUserIdAttribute($value){
        return ($value);
    }

    public function setUserIdAttribute($value){
        return $this->attributes['user_id'] = ($value);
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
}
