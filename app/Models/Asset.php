<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset extends Model
{
    use HasFactory,LogsActivity;
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
    }
    protected static $logAttributes = ["name","code","parameter","group_id","make","model","range","resolution","status", "accuracy", "certificate_no", "serial_no", "traceability", "location", "image", "due", "calibration_interval", "commissioned", "calibration"];
    protected static $logOnlyDirty = true;
}
