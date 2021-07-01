<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Preference extends Model
{
    public function child(){
        return $this->hasMany(self::class,'category','id');
    }
    use HasFactory;
    use LogsActivity;
    protected static $logAttributes = ["name","category","slug","value"];
    protected static $logOnlyDirty = true;
}
