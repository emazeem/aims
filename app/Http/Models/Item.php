<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id')->withDefault();
        //
    }
    public function capabilities(){
        return $this->belongsTo('App\Models\Capabilities','capability')->withDefault();
        //
    }
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
        //
    }
    public function quotes(){
        return $this->belongsTo('App\Models\Quotes','quote_id')->withDefault();
        //
    }
}
