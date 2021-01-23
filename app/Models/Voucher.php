<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Voucher extends Model
{
    use HasFactory;
    public function createdby(){
        return $this->belongsTo('App\Models\User','created_by')->withDefault();
    }
    public function details(){
        return $this->hasMany('App\Models\Voucherdetails','v_id','id');
    }
    protected $dates=['v_date'];
    use LogsActivity;
    protected static $logAttributes = ["customize_id","v_date","v_type","created_by","updated_by","created_at","updated_at"];
    protected static $logOnlyDirty = true;
}

