<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expensecategory extends Model
{
    use HasFactory;

    public function parent(){
        return $this->hasOne( self::class, 'id', 'parent_id' )->withDefault();
    }
}
