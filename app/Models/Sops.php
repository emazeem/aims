<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sops extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function reviewedby(){
        return $this->belongsTo('App\Models\User','reviewed_by')->withDefault();
    }

    public function child(){
        return $this->hasMany( self::class, 'parent_id', 'id' );
    }
}
