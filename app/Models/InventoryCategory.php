<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;
    protected $table='inventorycategories';
    public function parent(){
        return $this->belongsTo( self::class, 'parent_id' );
    }

    public function account3(){
        return $this->belongsTo( 'App\Models\AccLevelThree', 'acc_id');
    }
    public function account4(){
        return $this->belongsTo( 'App\Models\Chartofaccount', 'acc_id');
    }




}
