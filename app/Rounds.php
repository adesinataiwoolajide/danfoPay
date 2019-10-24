<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
class Rounds extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'rounds';
    protected $primaryKey = 'round_id';

    protected $fillable = [
        'vehicle_id', 'current_balance',
    ];

    protected static $logAttributes = ['vehicle_id', 'current_balance'];

    public function getVehicleIdAttribute($value){
        return ($value);
    }

    public function setVehicleIdAttribute($value){
        return $this->attributes['vehicle_id'] = ($value);
    }

    public function getCurrentBalanceAttribute($value){
        return ($value);
    }

    public function setCurrentBalanceAttribute($value){
        return $this->attributes['current_balance'] = ($value);
    }

    public function motto(){
        return $this->belongsTo('App\Vehicle','vehicle_id');
    }

}
