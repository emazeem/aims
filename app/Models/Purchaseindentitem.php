<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaseindentitem extends Model
{
    use HasFactory;
    public function receivings(){
        return $this->hasMany('App\Models\Materialreceiving','purchase_indent_item_id','id');
    }
}
