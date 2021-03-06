<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Job extends Model
{
    use HasFactory,LogsActivity;
    protected $dates=['created_at'];
    public function quotes(){
        return $this->belongsTo('App\Models\Quotes','quote_id');
    }
    public function invoices(){
        return $this->belongsTo('App\Models\Invoice','id','job_id')->withDefault();
    }

    public function siteplanings(){
        return $this->hasMany('App\Models\SitePlan','job_id');
    }
    public function jobitems(){
        return $this->hasMany('App\Models\Jobitem','job_id');
    }
    public function dn(){
        return $this->hasMany('App\Models\DeliveryNotes','job_id');
    }
    public function receivings(){
        return $this->hasMany('App\Models\ItemRecieving','job');
    }

    protected static $logAttributes = ['quotes_id','status'];
    protected static $logOnlyDirty = true;

}
