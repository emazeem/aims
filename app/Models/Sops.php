<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Sops extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function reviewedby(){
        return $this->belongsTo('App\Models\User','reviewed_by')->withDefault();
    }

    public function child(){
        return $this->hasMany( self::class, 'parent_id', 'id' );
    }


    use LogsActivity;
    protected static $logAttributes = ["name","parent_id","issue_no","rev_no","doc_no","file","issue","reviewed_on","reviewed_by","status","location","mode_of_storage"];
    protected static $logOnlyDirty = true;
}