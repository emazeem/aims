<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Chartofaccount extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;
    protected static $logAttributes = ['code1','code2','code3','acc_code','title'];
    protected static $logOnlyDirty = true;

    protected $table='acc_level_fours';
    public function codeone(){
        return $this->belongsTo('App\Models\AccLevelOne','code1');
    }
    public function codetwo(){
        return $this->belongsTo('App\Models\AccLevelTwo','code2');
    }
    public function codethree(){
        return $this->belongsTo('App\Models\AccLevelThree','code3');
    }
    public function cc(){
        return $this->hasMany('App\Models\CostCenter','parent_id','id');
    }

}
