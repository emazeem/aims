<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AccLevelThree extends Model
{
    public function levelfour(){
        return $this->hasMany('App\Models\Chartofaccount', 'code3');
    }
    use HasFactory,LogsActivity;
    protected static $logAttributes = ['code1','code2','title'];
    protected static $logOnlyDirty = true;
    public function codeone(){
        return $this->belongsTo('App\Models\AccLevelOne','code1');
    }
    public function codetwo(){
        return $this->belongsTo('App\Models\AccLevelTwo','code2');
    }

}
