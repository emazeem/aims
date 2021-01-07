<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;
    public function parents(){
        return $this->belongsTo('App\Models\Parameter','parent','id')->withDefault();
    }
}
