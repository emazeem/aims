<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccLevelTwo extends Model
{
    use HasFactory;
    public function codeone(){
        return $this->belongsTo('App\Models\AccLevelOne','code1');
    }
}
