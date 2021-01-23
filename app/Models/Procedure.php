<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Procedure extends Model
{
    use HasFactory,LogsActivity;
    public function parameters(){
        return $this->belongsTo(
            'App\Models\Parameter','parameter');
    }
    public function columns(){
        return $this->hasMany('App\Models\Column', 'assets');
    }

    protected static $logAttributes = ['name','uncertainties','description'];
    protected static $logOnlyDirty = true;


}
