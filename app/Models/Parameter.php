<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Parameter extends Model
{
    use HasFactory,LogsActivity,SoftDeletes;
    public function parents(){
        return $this->belongsTo('App\Models\Parameter','parent','id')->withDefault();
    }
    protected static $logAttributes = ['name','parent'];
    protected static $logOnlyDirty = true;

}
