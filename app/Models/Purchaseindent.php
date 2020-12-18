<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaseindent extends Model
{
    use HasFactory;
    public function indent_items(){
        return $this->hasMany('App\Models\Purchaseindentitem','indent_id','id');
    }
}
