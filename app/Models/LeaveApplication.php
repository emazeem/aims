<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LeaveApplication extends Model
{
    use HasFactory;
    public function appraisal(){
        return $this->belongsTo('App\Models\User','appraisal_id','id');
    }
    public function nature(){
        return $this->belongsTo('App\Models\Preference','nature_of_leave','slug');
    }
    public function head(){
        return $this->belongsTo('App\Models\User','head_id','id');
    }
    public function ceo(){
        return $this->belongsTo('App\Models\User','ceo_id','id');
    }
    protected $dates = ['from','to'];

    use LogsActivity;
    protected static $logAttributes = ["appraisal_id","nature_of_leave","type_of_leave","type_time","from","to","reason","address_contact","head_id","head_recommendation_status","head_recommendation_date","head_remarks","ceo_id","ceo_recommendation_status","ceo_recommendation_date","ceo_remarks"];
    protected static $logOnlyDirty = true;

}

