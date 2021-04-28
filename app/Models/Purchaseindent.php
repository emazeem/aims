<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Purchaseindent extends Model
{
    use HasFactory;
    protected $dates=['required','created_at'];
    public function indent_items(){
        return $this->hasMany('App\Models\Purchaseindentitem','indent_id','id');
    }
    public function indent_vendors(){
        return $this->hasMany('App\Models\PurchaseVendor','purchase_indent_id','id');
    }

    public function indenters(){
        return $this->belongsTo('App\Models\User','indenter');
    }
    public function selectedvendors(){
        return $this->belongsTo('App\Models\PurchaseVendor','selected_vendor');
    }

    public function checkedBy(){
        return $this->belongsTo('App\Models\User','checked_by');
    }
    public function approvedBy(){
        return $this->belongsTo('App\Models\User','approved_by');
    }
    public function departments(){
        return $this->belongsTo('App\Models\Department','department_id');
    }



    use LogsActivity;
    protected static $logAttributes = ["location","department","indent_by","checked_by","approved_by","indent_type","deliver_to","status","required"];
    protected static $logOnlyDirty = true;
}

