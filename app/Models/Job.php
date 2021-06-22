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
    public function siteplanings(){
        return $this->hasMany('App\Models\SitePlan','job_id');
    }
    public function jobitems(){
        return $this->hasMany('App\Models\JobItem','job_id');
    }


    protected static $logAttributes = ['quotes_id','status'];
    protected static $logOnlyDirty = true;

}
