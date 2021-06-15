<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Nofacility extends Model
{
    use HasFactory,LogsActivity,SoftDeletes;
    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer','id')->withDefault();
    }
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter','id')->withDefault();
    }

    protected static $logAttributes = ['capability','item_id'];
    protected static $logOnlyDirty = true;

}
