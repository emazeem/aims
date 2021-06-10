<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Unit extends Model
{
    use HasFactory,LogsActivity;
    use SoftDeletes;
    public function parameters(){
        return $this->belongsTo('App\Models\Parameter','parameter')->withDefault();
        //
    }
    public function others(){
        return $this->hasMany( self::class, 'primary_', 'id' );
    }

    protected static $logAttributes = ['parameter','unit'];
    protected static $logOnlyDirty = true;
}
