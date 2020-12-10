<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
    }

}
