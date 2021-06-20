<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function assets(){
        dd($this);
        return $this->belongsTo('App\Models\Asset','asset','id')->withDefault();
    }
}
