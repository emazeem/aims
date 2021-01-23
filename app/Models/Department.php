<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Department extends Model
{
    use HasFactory,LogsActivity;
    public function heads(){
        return $this->belongsTo('App\Models\User','head','id')->withDefault();
    }

    protected static $logAttributes = ['name', 'head'];
    protected static $logOnlyDirty = true;
}
