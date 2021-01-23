<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Assetgroup extends Model
{
    use HasFactory,LogsActivity;
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter');
    }

    protected static $logAttributes = ['parameter','name'];
    protected static $logOnlyDirty = true;
}
