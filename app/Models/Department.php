<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public function heads(){
        return $this->belongsTo('App\Models\User','head','id')->withDefault();
    }
}
