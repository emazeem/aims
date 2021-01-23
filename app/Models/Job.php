<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Job extends Model
{
    use HasFactory,LogsActivity;

    public function quotes(){
        return $this->belongsTo('App\Models\Quotes','quote_id');
    }
    protected static $logAttributes = ['quotes_id','status'];
    protected static $logOnlyDirty = true;

}
