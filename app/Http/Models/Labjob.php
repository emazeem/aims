<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labjob extends Model
{
    use HasFactory;
    public function items(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
    public function jobs(){
        return $this->belongsTo('App\Models\Job','job_id');
    }

}
