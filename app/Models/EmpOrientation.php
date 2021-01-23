<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class EmpOrientation extends Model
{
    use HasFactory;

    use LogsActivity;
    protected static $logAttributes = ["appraisal_id","termination_period","probation_applicable","probation_period","designations","place_of_work","salary","allowances","cnic", "representative", "commencement", "status", "signature", "hr_user_id", "joining", "o_area", "remarks"];
    protected static $logOnlyDirty = true;
}
