<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    public function sitejobs(){
        return $this->belongsTo('App\Models\Sitejob','job')->withDefault();
    }
    public function labjobs(){
        return $this->belongsTo('App\Models\Labjob','job')->withDefault();
    }


}
