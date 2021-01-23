<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Requisition extends Model
{
    use HasFactory;
    public function designation(){
        return $this->belongsTo('App\Models\Designation','requisition_designation');
    }
    public function initiated_user(){
        return $this->belongsTo('App\Models\User','initiated_by');
    }

    use LogsActivity;
    protected static $logAttributes = ["requisition_designation","reason","qualification","special_skills","initiated_by","time_frame","hrd_review","approved_by","remarks"];
    protected static $logOnlyDirty = true;
}
