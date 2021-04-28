<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseVendor extends Model
{
    use HasFactory;
    public function vendors(){
        return $this->belongsTo('App\Models\Vendors','vendor');
    }
}
