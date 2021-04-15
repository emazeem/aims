<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDetails extends Model
{
    use HasFactory;
    public function account(){
        return $this->belongsTo('App\Models\Chartofaccount','acc_code','acc_code');
    }
    public function parent(){
        return $this->belongsTo('App\Models\Journal','parent_id','id');
    }

}
