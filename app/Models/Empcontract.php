<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Empcontract extends Model
{
    use HasFactory;
    public function appraisal(){
        return $this->belongsTo('App\Models\Interviewappraisal','appraisal_id','id');
    }
    public function designation(){
        return $this->belongsTo('App\Models\Designation','designations');
    }
    public function orientators(){
        return $this->belongsTo('App\Models\User','orientator');
    }
    public function hr(){
        return $this->belongsTo('App\Models\User','hr_user_id');
    }

    protected $dates=['commencement','joining'];
    use LogsActivity;
    protected static $logAttributes = ["appraisal_id","termination_period","probation_applicable","probation_period","designations","place_of_work","salary","allowances","cnic", "representative", "commencement", "status", "signature", "hr_user_id", "joining", "o_area", "remarks"];
    protected static $logOnlyDirty = true;
}
