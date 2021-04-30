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
    public function po_items(){
        return $this->hasMany('App\Models\PoDetails','po_id','id');
    }
}
