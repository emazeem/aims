<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use SoftDeletes;
    use HasFactory,LogsActivity;

    public function regions()
    {
        return $this->belongsTo('App\Models\Preference', 'region');
    }
    protected $table='customers';
    protected static $logAttributes = ["reg_name","ntn","region","address","credit_limit","customer_type","pay_terms","prin_name_1","prin_phone_1", "prin_email_1", "prin_name_2", "prin_phone_2", "prin_email_2", "prin_name_3", "prin_phone_3", "prin_email_3", "pur_name", "pur_phone", "pur_email", "acc_name", "acc_phone", "acc_email", "deleted_at", "created_at", "updated_at"];
    protected static $logOnlyDirty = true;
    public function contacts(){
        return $this->hasMany('App\Models\CustomerContact','customer_id','id');
    }

}