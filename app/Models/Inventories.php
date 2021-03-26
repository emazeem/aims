<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventories extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo('App\Models\Inventorycategory','category_id','id');
    }
    public function departments(){
        return $this->belongsTo('App\Models\Department','department_id')->withDefault();
    }
    public function quantities(){
        return $this->hasMany('App\Models\InventoriesQuantity','inventory_id','id');
    }
}
