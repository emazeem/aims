<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicingLedger extends Model
{
    use HasFactory;
    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id');
    }
    public function created_user(){
        return $this->belongsTo('App\Models\User','created_by')->withDefault();
    }
}
