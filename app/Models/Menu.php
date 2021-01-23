<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function parent(){
        return $this->hasMany( self::class, 'parent_id' );
    }

    use LogsActivity;
    protected static $logAttributes = ["name","slug","icon","status","url","position","parent_id","has_child"];
    protected static $logOnlyDirty = true;
}
