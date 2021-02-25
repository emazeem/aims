<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incubatormapping extends Model
{
    use HasFactory;
    public function parent(){
        return $this->belongsTo( 'App\Models\Calculatorentries', 'parent_id', 'id' );
    }
}
