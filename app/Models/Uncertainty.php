<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Uncertainty extends Model
{
    use HasFactory,LogsActivity;
    protected static $logAttributes = ["name","slug","formula","coefficient_of_sensitivity","distribution"];
    protected static $logOnlyDirty = true;
}
