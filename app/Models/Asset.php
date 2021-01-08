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
    protected static $logAttributes = ['id', 'name', 'parameter','make','model'];
    protected static $logOnlyDirty = true;


}
