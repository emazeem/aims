<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    public function designation(){
        return $this->belongsTo('App\Models\Designation','requisition_designation');
    }
    public function initiated_user(){
        return $this->belongsTo('App\Models\User','initiated_by');
    }


}
