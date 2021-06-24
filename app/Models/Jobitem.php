<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Jobitem extends Model
{
    use HasFactory, LogsActivity;

    public function item()
    {
        return $this->belongsTo('App\Models\QuoteItem', 'item_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Item', 'quote_id');
        //
    }

    public function jobs()
    {
        return $this->belongsTo('App\Models\Job', 'job_id');
    }

    public function general()
    {
        return $this->belongsTo('App\Models\Calculatorentries', 'id','job_type_id');
    }
    public function receiving_user()
    {
        return $this->belongsTo('App\Models\User', 'id','store_incharge_id')->withDefault();
    }


    protected static $logAttributes = ["type", "job_id", "item_id", "eq_id", "serial", "resolution", "accuracy", "range", "model", "make", "accessories", "visual_inspection", "status", "start", "end", "started_at", "ended_at", "assign_user", "assign_assets", "group_users", "group_assets", "certificate"];
    protected static $logOnlyDirty = true;
}
