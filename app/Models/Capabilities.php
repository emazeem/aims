<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capabilities extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
    }
    public function procedures(){
        return $this->belongsTo(
            'App\Models\Procedure','procedure');
    }
}
