<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    use HasFactory;
    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id')->withDefault();
        //
    }
    public function users(){
        return $this->belongsTo('App\Models\User','tm')->withDefault();
        //
    }

    public function capabilities(){
        return $this->belongsTo('App\Models\Capabilities','capability')->withDefault();
        //
    }
    public function items(){
        return $this->hasMany('App\Models\Item','quote_id');
        //
    }
    public function logs(){
        return $this->hasMany('App\Models\Quoterevisionlog','quote_id');
    }
}
