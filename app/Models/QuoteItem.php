<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class QuoteItem extends Model
{
    use HasFactory,LogsActivity,SoftDeletes;
    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id')->withDefault();
        //
    }
    public function capabilities(){
        return $this->belongsTo('App\Models\Capabilities','capability')->withDefault();
        //
    }
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
        //
    }
    public function quotes(){
        return $this->belongsTo('App\Models\Quotes','quote_id')->withDefault();
        //
    }
    protected static $logAttributes = ["quote_id","status","parameter","capability","not_available","location","accredited","range","price","quantity","rf_checks"];
    protected static $logOnlyDirty = true;
}
