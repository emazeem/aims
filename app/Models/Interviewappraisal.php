<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviewappraisal extends Model
{
    use HasFactory;
    public function evaluators(){
         return $this->belongsTo('App\Models\User','evaluator');
    }
    public function suitable_departments(){
         return $this->belongsTo('App\Models\Department','suitable_for_other_department');
    }

}
