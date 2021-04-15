<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Journal extends Model
{
    use LogsActivity;
    protected static $logAttributes = [ "id","customize_id","date","type","created_by","updated_by","acc_code","narration","dr","cr"];
    protected static $logOnlyDirty = true;
    protected $dates=['date'];
    public function createdby(){
        return $this->belongsTo('App\Models\User','created_by')->withDefault();
    }
    public function chartofaccount(){
        return $this->belongsTo('App\Models\Chartofaccount','acc_code','acc_code');
    }
    public function details(){
        return $this->hasMany('App\Models\JournalDetails','parent_id','id');
    }
    use HasFactory;
}
