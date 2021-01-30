<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    public function createdby(){
        return $this->belongsTo('App\Models\User','created_by')->withDefault();
    }
    use HasFactory;
}
