<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Formsandformats extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function reviewedby(){
        return $this->belongsTo('App\Models\User','reviewed_by')->withDefault();
    }

    use LogsActivity;
    protected static $logAttributes = ["name","sops","parent_id","doc_no","rev_no","issue_no","file","issue","reviewed_on","reviewed_by","status","location","mode_of_storage"];
    protected static $logOnlyDirty = true;
}