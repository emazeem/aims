<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public function job(){
        return $this->belongsTo('App\Models\Job','job_id');
    }
    protected $dates=['created_at'];
}
