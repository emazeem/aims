<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
