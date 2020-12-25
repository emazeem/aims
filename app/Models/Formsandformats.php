<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formsandformats extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function reviewedby(){
        return $this->belongsTo('App\Models\User','reviewed_by')->withDefault();
    }
}
