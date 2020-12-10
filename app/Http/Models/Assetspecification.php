<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assetspecification extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function columns(){
        return $this->belongsTo('App\Models\Column','column');
    }
}
