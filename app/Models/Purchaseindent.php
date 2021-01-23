<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Purchaseindent extends Model
{
    use HasFactory;
    public function indent_items(){
        return $this->hasMany('App\Models\Purchaseindentitem','indent_id','id');
    }
    public function indenter(){
        return $this->belongsTo('App\Models\User','indent_by');
    }
    public function checkedBy(){
        return $this->belongsTo('App\Models\User','checked_by');
    }
    public function approvedBy(){
        return $this->belongsTo('App\Models\User','approved_by');
    }
    public function departments(){
        return $this->belongsTo('App\Models\Department','department');
    }



    use LogsActivity;
    protected static $logAttributes = ["location","department","indent_by","checked_by","approved_by","indent_type","deliver_to","status","required"];
    protected static $logOnlyDirty = true;
}

