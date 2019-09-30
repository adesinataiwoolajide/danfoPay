<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BulkSms extends Model
{
    use SoftDeletes;

    protected $table = 'bulk_sms';
    public $primaryKey = 'sms_id';
    protected $guard_name = 'web';
    protected $fillable = [
        'message', 'phone_number', 'subject'
    ];

    public function getMessageAttribute($value){
        return ($value);
    }

    public function setMessageAttribute($value){
        return $this->attributes['message'] = ($value);
    }
    public function getPhoneNumberAttribute($value){
        return ($value);
    }

    public function setPhoneNumberAttribute($value){
        return $this->attributes['phone_number'] = ($value);
    }

    public function getSubjectAttribute($value){
        return ($value);
    }

    public function setSubjectAttribute($value){
        return $this->attributes['subject'] = ($value);
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
