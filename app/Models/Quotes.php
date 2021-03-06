<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Quotes extends Model
{
    use HasFactory,LogsActivity,SoftDeletes;
    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id')->withDefault();
        //
    }
    public function users(){
        return $this->belongsTo('App\Models\User','tm')->withDefault();
        //
    }

    public function capabilities(){
        return $this->belongsTo('App\Models\Capabilities','capability')->withDefault();
        //
    }
    public function principals(){
        return $this->belongsTo('App\Models\CustomerContact','principal')->withDefault();
        //
    }


    public function items(){
        return $this->hasMany('App\Models\QuoteItem','quote_id');
        //
    }
    public function jobs(){
        return $this->hasMany('App\Models\Job','quote_id');
        //
    }

    public function attachments(){
        return $this->hasMany('App\Models\QuotesAttachments','quote_id');
        //
    }

    public function logs(){
        return $this->hasMany('App\Models\Quoterevisionlog','quote_id');
    }
    protected static $logAttributes = ["customer_id","type","rfq_mode","rfq_mode_details","approval_mode","approval_mode_details","approval_date","status","turnaround", "remarks", "tm", "principal", "revision"];
    protected static $logOnlyDirty = true;

}
