<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Designation extends Model
{
    use HasFactory,LogsActivity;
    public function departments(){
        return $this->belongsTo(
            'App\Models\Department','department_id');
    }
    protected static $logAttributes=["department_id","name"];
    protected static $logOnlyDirty = true;
}


