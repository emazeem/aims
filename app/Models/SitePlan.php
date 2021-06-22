<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePlan extends Model
{
    use HasFactory;
    public function jobs(){
        return $this->belongsTo('App\Models\Job','job_id');
    }
}
