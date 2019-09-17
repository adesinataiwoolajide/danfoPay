<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FundTransfer extends Model
{
    use SoftDeletes;

    protected $table = 'fund_transfers';
    public $primaryKey = 'fund_id';
    protected $guard_name = 'web';
    protected $fillable = [
        'sender', 'reciever', 'amount'
    ];

    public function getTotalAttribute($value){
        return ($value);
    }

    public function setTotalAttribute($value){
        return $this->attributes['amount'] = ($value);
    }
    public function getSenderAttribute($value){
        return ($value);
    }

    public function setSenderAttribute($value){
        return $this->attributes['sender'] = ($value);
    }
    public function getRecieverAttribute($value){
        return ($value);
    }

    public function setRecieverAttribute($value){
        return $this->attributes['reciever'] = ($value);
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
