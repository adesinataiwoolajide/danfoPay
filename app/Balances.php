<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class Balances extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'balances';
    public $primaryKey = 'balance_id';
    protected $guard_name = 'web';
    protected $fillable = [
        'total_amount', 'user_id', 'customer_code'
    ];

    protected static $logAttributes = ['total_amount', 'user_id', 'customer_code'];

    public function getTotalAmountAttribute($value){
        return ($value);
    }

    public function setTotalAmountAttribute($value){
        return $this->attributes['total_amount'] = ($value);
    }
    public function getCustomerCodeAttribute($value){
        return ($value);
    }

    public function setCustomerCodeAttribute($value){
        return $this->attributes['customer_code'] = ($value);
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

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }
}
