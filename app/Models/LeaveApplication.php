<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;
    public function appraisal(){
        return $this->belongsTo('App\Models\Interviewappraisal','appraisal_id','id');
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
}
