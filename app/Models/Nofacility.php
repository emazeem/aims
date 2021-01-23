<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Nofacility extends Model
{
    use HasFactory,LogsActivity;
    protected static $logAttributes = ['capability','item_id'];
    protected static $logOnlyDirty = true;

}
