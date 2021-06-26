<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePassItems extends Model
{
    use HasFactory;
    public function items(){
        return $this->belongsTo('App\Models\Asset','item_id','id')->withDefault();
    }
    public function fcbout(){
        return $this->belongsTo('App\Models\User','out_fcb','id')->withDefault();
    }
    public function fcbin(){
        return $this->belongsTo('App\Models\User','in_fcb','id')->withDefault();
    }


}
