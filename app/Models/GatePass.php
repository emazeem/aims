<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatePass extends Model
{
    use HasFactory;
    public function gpitems(){
        return $this->hasMany('App\Models\GatePassItems','gp_id','id');
    }
    public function outreceivedby(){
        return $this->belongsTo('App\Models\User','out_handed_over_by','id')->withDefault();
    }
    public function outreceivedfrom(){
        return    $this->belongsTo('App\Models\User','out_received_by','id')->withDefault();
    }
    public function plan(){
        return $this->belongsTo('App\Models\SitePlan','plan_id','id')->withDefault();
    }

    protected $dates=['out'];
}
