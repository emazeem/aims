<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Attendance extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    use LogsActivity;
    protected static $logAttributes = ["user_id","check_in_date","check_out_date","check_in","check_out","day","worked_hours","status","leave_id","remarks"];
    protected static $logOnlyDirty = true;
}

