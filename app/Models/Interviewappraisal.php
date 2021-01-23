<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Interviewappraisal extends Model
{
    use HasFactory;
    public function evaluators(){
         return $this->belongsTo('App\Models\User','evaluator');
    }
    public function suitable_departments(){
         return $this->belongsTo('App\Models\Department','suitable_for_other_department');
    }
    use LogsActivity;
    protected static $logAttributes = ["fname","lname","age","basic_qualification","basic_qualification_duration","highest_qualification","highest_qualification_duration","bu_for_candidate","relevant_experience","total_experience","last_salary","desired_salary","personal_traits","suitable_for_other_department","evaluator"];
    protected static $logOnlyDirty = true;
}
