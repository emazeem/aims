<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobitem extends Model
{
    use HasFactory;
    public function item(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
    public function items(){
        return $this->hasMany('App\Models\Item','quote_id');
        //
    }

    public function jobs(){
        return $this->belongsTo('App\Models\Job','job_id');
    }
}
