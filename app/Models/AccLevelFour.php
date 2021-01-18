<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccLevelFour extends Model
{
    use HasFactory;
    public function codeone(){
        return $this->belongsTo('App\Models\AccLevelOne','code1');
    }
    public function codetwo(){
        return $this->belongsTo('App\Models\AccLevelTwo','code2');
    }
    public function codethree(){
        return $this->belongsTo('App\Models\AccLevelThree','code3');
    }

}
