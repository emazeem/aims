<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Capabilities extends Model
{
    use SoftDeletes,LogsActivity;
    use HasFactory;
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
    }
    public function procedures(){
        return $this->belongsTo(
            'App\Models\Procedure','procedure')->withDefault();
    }
    public function units(){
        return $this->belongsTo('App\Models\Unit','unit','id')->withDefault();
    }
    public function calculators(){
        return $this->belongsTo('App\Models\Preference','calculator','slug')->withDefault();
    }
    public function multis(){
        return $this->hasMany( self::class, 'group_id', 'id' );
    }
    protected static $logAttributes = ["name","parameter","procedure","range","price","accuracy","unit","remarks","location","accredited"];
    protected static $logOnlyDirty = true;
}
