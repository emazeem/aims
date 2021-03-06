<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
    protected $table='po';
    use HasFactory;
    protected $dates=['created_at'];
    public function createdBy(){
        return $this->belongsTo('App\Models\User','created_by');
    }
    public function indent(){
        return $this->belongsTo('App\Models\Purchaseindent','indent_id');
    }

    public function po_items(){
        return $this->hasMany('App\Models\Purchaseindentitem','indent_id','indent_id');
    }
    public function grn(){
        return $this->hasMany('App\Models\GrnVoucher','po_id','id');
    }

    public function po_recievings(){
        return $this->hasMany('App\Models\Materialreceiving','purchase_indent_item_id','indent_id');
    }


}
