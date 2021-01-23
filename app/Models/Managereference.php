<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Managereference extends Model
{
    use HasFactory,LogsActivity;
    public function assets(){
        return $this->belongsTo('App\Models\Asset','asset')->withDefault();
        //
    }
    public function units(){
        return $this->belongsTo('App\Models\Unit','unit')->withDefault();
        //
    }
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
        //
    }
    protected static $logAttributes = [ "parameter", "asset", "unit", "uuc", "ref", "error", "uncertainty"];
    protected static $logOnlyDirty = true;

}
