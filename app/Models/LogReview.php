<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogReview extends Model
{
    use HasFactory;
    public function createdby(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
    protected $dates=['start','end','started','ended'];
}
