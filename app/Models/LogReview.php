<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogReview extends Model
{
    use HasFactory;
    public function createdby(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }
    public function assignto(){
        return $this->belongsTo('App\Models\User','assign_to','id');
    }
    protected $dates=['start','end','started','ended'];
}
