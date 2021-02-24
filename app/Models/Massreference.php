<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Massreference extends Model
{
    use HasFactory;
    public function parent(){
        return $this->belongsTo('App\Models\Managereference','parent_id','id');
    }
}
