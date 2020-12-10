<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    public function departments(){
        return $this->belongsTo(
            'App\Models\Department','department_id');
    }
}
